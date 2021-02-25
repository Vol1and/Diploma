<?php


namespace App\Services;

use App\Models\FinanceDocument;
use App\Repositories\ButchNumberConnectionsRepository;
use App\Repositories\CharacteristicPricesRepository;
use App\Repositories\CharacteristicsRepository;
use App\Repositories\FinanceDocumentsRepository;
use App\Repositories\FinanceDocumentTableRowsRepository;
use Carbon\Carbon;

class CreateFinanceDocumentService
{

    public function makeFinanceDoc($data)
    {
        $createButchNumberConnectionService = app(CreateButchNumberConnectionService::class);
        $createWorkplaceDocumentConnectionService = app(CreateWorkplaceDocumentConnectionService::class);

        $rest = substr($data['date'], 0, -3);
        $date = Carbon::createFromTimestamp($rest, 'Europe/Moscow')->toDateTimeString();


        if($data['doc_type_id'] != 1) $agent_id = 1;
        else $agent_id = $data['agent_id'];

        // заполнение сущности документа
        $doc = (new FinanceDocument())->create(['agent_id' => $agent_id,
            'comment' => $data['comment'],
            'date' =>  $date,
            'is_set' => false,
            'doc_type_id' => $data['doc_type_id'],
            'storage_id'=> $data['storage_id'],
            'doc_sum' => $data['doc_sum']
        ]);

        // TODO: ЗАГЛУШКА! Устранить когда введётся авторизация и рабочие места!

        // создание номера партии по номеру документа если это получение
        if($doc->doc_type_id == 1) $createButchNumberConnectionService->make(['butch_number' => $doc->id]);
        else $createWorkplaceDocumentConnectionService->make(['workplace_id' => 1, 'document_id' => $doc->id, 'user_id' => 3]);

        return $doc;
    }

    // заполнение сущностей данными
    public function fillData($doc, $med)
    {
        $createCharacteristicPriceService= app(CreateCharacteristicPriceService::class);
        $financeDocumentTableRowsRepository = app(FinanceDocumentTableRowsRepository::class);
        $characteristicPricesRepository= app(CharacteristicPricesRepository::class);
        $characteristicsRepository= app(CharacteristicsRepository::class);
        $createFinanceDocumentTableRowService = app(CreateFinanceDocumentTableRowService::class);


        // поиск выбранной характеристики для выбранной номенклатуры в БД по id
        $characteristic = $characteristicsRepository->findById($med['nomenclature_id'],$med['characteristic_id']);

        // получение строки таблицы для обновления
        $tableRow = $financeDocumentTableRowsRepository->find($med['id']);

        // если нашлась
        if ($characteristic) {

            // проверка соответствия цены характеристики из респонса к цене в БД
            $checkPrice = $characteristicPricesRepository->getLatestPriceForCharacteristic($characteristic->id);

            // если назначается первая цена - устанавливается цена из строки документа
            if ($checkPrice->price != $med['sell_price']) {

                // создаётся новая цена, с привязкой к характеристике из БД, переоценивая остатки
                $cp = $createCharacteristicPriceService->makeUpdate($med);
                if (!$cp) return response(['error' => "Сущность цены характеристики не добавлена"], 500);

                // в характеристике обновляется id цены
                $characteristic->update(['characteristic_price_id' => $cp->id]);
            }

            // обновление строки документа если есть, иначе создание новой
            if ($tableRow) {
                if($doc->doc_type_id == 1) $tableRow->update(['price' => $med['income_price']] + $med);
                else $tableRow->update(['price' => $med['sell_price']] + $med);
            }
            else {
                $tableRow = $createFinanceDocumentTableRowService->fillTableRow($doc, $med, $med['characteristic_id']);
                if (!$tableRow) return response(['error' => "Строка документа не была создана"], 500);
            }
        } else return response(['error' => "Характеристика не была выбрана для строки документа"], 500);

        return $tableRow;
    }


    // метод сохранения приходного документа
    public function createFinanceDoc($data, $meds)
    {
        // добавление нового документа
        $doc = $this->makeFinanceDoc($data);


        if($doc){
            // циклический проход по массиву медикаментов
            foreach ($meds as $row) {

                $result = $this->fillData($doc, $row);
                if (!$result) return response(null,500);

            } // foreach

        }
        return $doc;
    }



    // метод проведения документа
    public function pushFinanceDoc($doc_id)
    {
        $financeDocumentTableRowsRepository = app(FinanceDocumentTableRowsRepository::class);
        $financeDocumentsRepository = app(FinanceDocumentsRepository::class);
        $createWareConnectionService = app(CreateWareConnectionService::class);
        $characteristicsRepository = app(CharacteristicsRepository::class);
        $createFinanceDocumentTableRowService = app(CreateFinanceDocumentTableRowService::class);
        $butchNumberConnectionRepository = app(ButchNumberConnectionsRepository::class);

        // получение документа
        $doc = $financeDocumentsRepository->find($doc_id);

        if ($doc['is_set'] == 1) return $doc;

        // получение строк документа
        $doc_rows = $financeDocumentTableRowsRepository->forPush($doc_id);

        if ($doc['doc_type_id'] != 1){

            foreach($doc_rows as $row) {

                $row_sale = $row['count'];
                $is_first_row = true;

                // партии с количествами продаваемого медикамента
                $wares = $characteristicsRepository->getCharacteristicWareButches($row['characteristic_id'], $doc->storage_id);


                foreach ($wares as $ware){

                    $tr = $financeDocumentTableRowsRepository->find($row['id']);

                    if($ware->ware >= $row_sale) {

                        if($is_first_row){
                            $wc = $createWareConnectionService->
                            make(['storage_id'=> $doc->storage_id, 'characteristic_id' => $row['characteristic_id'],
                                'change' => -$row_sale , 'butch_number_connection_id' => $ware->id
                            ]);
                            $tr->update(['ware_connection_id' => $wc->id]);
                            break;
                        } else {
                            $wc = $createWareConnectionService
                                ->make(['storage_id'=> $doc->storage_id, 'characteristic_id' => $row['characteristic_id'],
                                    'change' => -$row_sale, 'butch_number_connection_id' => $ware->id
                                ]);

                            $tr = $createFinanceDocumentTableRowService
                                ->fillTableRow($doc, ['finance_document_id' => $doc['id'], 'count' => $row_sale, 'sell_price' => $row['price']], $row['characteristic_id']);
                            $tr->update(['ware_connection_id' => $wc->id]);
                            break;
                        }
                    } else {
                        if($is_first_row) {

                            // если первая строка документа, но будет больше одной всего
                            $wc = $createWareConnectionService
                                ->make(['storage_id'=> $doc->storage_id, 'characteristic_id' => $row['characteristic_id'],
                                    'change' => -$ware->ware , 'butch_number_connection_id' => $ware->id
                                ]);

                            $tr->update(['count' => $ware->ware, 'ware_connection_id' => $wc->id]);


                            $row_sale -= $ware->ware;

                            $is_first_row = false;
                        } else {
                            $wc = $createWareConnectionService
                                ->make(['storage_id'=> $doc->storage_id, 'characteristic_id' => $row['characteristic_id'],
                                    'change' => -$ware->ware, 'butch_number_connection_id' => $ware->id
                                ]);


                            $tr = $createFinanceDocumentTableRowService
                                ->fillTableRow($doc, ['finance_document_id' => $doc['id'], 'count' => $ware->ware, 'sell_price' => $row['price']], $row['characteristic_id']);
                            $tr->update(['ware_connection_id' => $wc->id]);
                            $row_sale -= $ware->ware;
                        }
                    }
                }
            }
        } else {
            // циклический проход по массиву строк документа


            foreach ($doc_rows as $row) {

                $bn = $butchNumberConnectionRepository->findByButchNumber($doc->id);

                $result = $createWareConnectionService->make([ 'storage_id'=> $doc->storage_id,
                    'characteristic_id' => $row->characteristic_id, 'change' => $row['count'] , 'butch_number_connection_id' => $bn->id ]);
                if (!$result) return response(null,500);

                $tr = $financeDocumentTableRowsRepository->find($row['id']);

                $tr->update(['ware_connection_id' => $result->id]);
            } // foreach
        }

        // изменение состояния документа на "Проведён"
        $doc->update(['is_set' => true]);

        return $doc;
    }

    // функция отбирает только уникальные сущности из массива по указанному свойству
    function unique_multidim_array($array, $key) {
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach($array as $val) {

            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }


    // функция отбирает только уникальные сущности из массива по указанному свойству
    //function multiple_keys($array, $key) {
    //    $temp_array = array();          // возвращаемый массив
    //    $key_array = array();           // массив ключей
    //    $not_uniq_key_array = array();  // массив ключей строк с повторяющейся характеристикой
    //
    //    // цикл записывает в $temp_array строки с уникальными значениями $characteristic_id
    //    // так же формируется массив всех уникальных $characteristic_id
    //    $i = 0;
    //    foreach($array as $val) {
    //        if (!in_array($val[$key], $key_array)) {
    //            $key_array[$i] = $val[$key];
    //            $temp_array[$i] = $val;
    //        }
    //        $i++;
    //    }  // foreach
    //
    //    // создание массива из id строк с повторяющимися id характеристик
    //    foreach($key_array as $k) {
    //        $uniq_count = array_count_values(array_column($array, $key))[$k];
    //        if ($uniq_count > 1) $not_uniq_key_array[] = $k;
    //    }
    //
    //    // в цикле формируется результирующий массив, количества дублированных строк суммируются
    //    foreach($not_uniq_key_array as $not_uniq_key) {
    //
    //        // массив подсчёта финального количества
    //        $final_array = array();
    //
    //        // в массив $final_array добавляются все повторяющиеся строки с characteristic_id = $not_uniq_key
    //        $i = 0;
    //        foreach ($array as $item){
    //            if ($item[$key] == $not_uniq_key){
    //                $final_array[$i] = $item;
    //            }
    //            $i++;
    //        }
    //
    //        // агрегируется count повторяющихся строк
    //        $uniq_sum = array_sum(array_column($final_array, 'count'));
    //
    //        // в результирующий массив вносятся суммированные кол-ва повторявшихся строк
    //        foreach($temp_array as $k => &$v)
    //            if ($v[$key] ==  $not_uniq_key) $v["count"] = $uniq_sum;
    //
    //    } // foreach
    //
    //    // возвращается массив с уменьшенным кол-вом строк
    //    return $temp_array;
    //}

}
