<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentCreateRequest;
use App\Models\Characteristic;
use App\Models\CharacteristicPrice;
use App\Models\FinanceDocument;
use App\Models\FinanceDocumentTableRow;
use App\Models\WareConnection;
use App\Repositories\CharacteristicPricesRepository;
use App\Repositories\CharacteristicsRepository;
use App\Repositories\FinanceDocumentsRepository;
use App\Repositories\WareConnectionsRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FinanceDocumentController extends OriginController
{
    //ссылка на хранилище модели Producer
    private $financeDocumentsRepository;
    private $characteristicPricesRepository;
    private $characteristicsRepository;
    private $wareConnectionsRepository;

    public function __construct()
    {
        //вызов констракт у родителя
        parent::__construct();

        //инициализация хранилища
        $this->financeDocumentsRepository = app(FinanceDocumentsRepository::class);
        $this->characteristicPricesRepository = app(CharacteristicPricesRepository::class);
        $this->characteristicsRepository = app(CharacteristicsRepository::class);
        $this->wareConnectionsRepository = app(WareConnectionsRepository::class);
    }


    public function index()
    {
        return $this->financeDocumentsRepository->getTable()->toJson();
    }



    //принимает реквест DocumentCreateRequest
    public function store(DocumentCreateRequest $request)
    {
        //получение данных из реквеста
        $data = $request->input();
        //создание нового документа
        $item = new FinanceDocument($data);
        //сохраняем
        $item->save();

        //если все ок - возвращаем ответ со статусом 201
        if($item)
            return response(null, 201);
        //либо можно передавать айди созданного элемента
        //return response($item->id, 201);

        //если нет - отправляем ошибку (статус возмонжо стоит поменять)
        return response(null,500);

    }



    public function show($id)
    {
        $result = $this->financeDocumentsRepository->find($id);

        if(empty($result) || !$result){

            return response(null, 404);
        }
        return $result->toJson();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(DocumentCreateRequest $request)
    {
        //todo: реализовать логику для редактирования поступления
      //$item = $this->financeDocumentRepository->find($request->id);
      //if (empty($item)) {
      //    return response(null, 404);
      //}
      //$data = $request->all();
      //$result = $item->fill($data)->save();
      ////todo: подумать над кодом ошибки
      ////Что должно вовзращать при ошибке сохранения
      //if (!$result) {
      //    return response(null, 404);
      //}
      //else  return response(null, 200);
        return response(null, 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //todo: Реализовать логику для удаления поступления
        return response(null, 404);
        //
    }


    // метод создания приходного документа
    public function incomeCreate(DocumentCreateRequest $request)
    {
        // получение данных
        $data = $request->input('item');
        if(empty($data)) return response(null,204);

        $meds = $data['table_rows'];
        if(empty($meds)) return response(null,204);



        // добавление нового документа
        $doc = (new FinanceDocument())->create(['agent_id' => $data['agent_id'],'comment' => $data['comment'],
            'date' => Carbon::createFromTimestamp($data['date'], 'Europe/Moscow')->toDateTimeString() ,'is_set' => true, 'doc_type_id' => 1, 'storage_id'=> $data['storage_id'] ]);

        if($doc){
            // циклический проход по массиву медикаментов
            foreach ($meds as $med) {

                // создание цены для характеристики со значением характеристики по умолчанию
                $cp = CharacteristicPrice::create(['price' => $med['sell_price']]);
                if (!$cp) return response(null,500);

                $med['characteristic_price_id'] = $cp->id;
                // добавление новой характеристики
                $characteristic = (new Characteristic())->create($med);
                if (!$characteristic) return response(null,500);

                //создание проводки для регистр накопления
                $wc = (new WareConnection())->create(['storage_id'=> $data['storage_id'], 'characteristic_id' => $characteristic->id,'change' => $med['count']]);
                if (!$wc) return response(null,500);

                // добавление новой проводки документа
                $tableRow = (new FinanceDocumentTableRow())->create(['characteristic_id' => $characteristic->id,
                    'ware_connection_id' =>  $wc->id, 'finance_document_id' => $doc->id,
                    'count' => $med['count'], 'price' => $med['income_price']]);
                if (!$tableRow) return response(null,500);

                // добавление значения id характеристики в таблицу Цены характеристик
                $cp->update(['characteristic_id' => $characteristic->id]);

            } // foreach
        }
    } // incomeCreate


    // метод создания приходного документа
    public function incomeUpdate(DocumentCreateRequest $request, $id)
    {
        // поиск Документа найден по id
        // $doc = FinanceDocument::find($id);
        $doc = $this->financeDocumentsRepository->find($id);
        if (empty($doc)) return response(null,204);

        // получение данных
        $data = $request->input('item');
        if(empty($data)) return response(null,204);

        $meds = $data['table_rows'];
        if(empty($meds)) return response(null,204);


        // обновление информации о документе
        $doc->update(['agent_id' => $data['agent_id'],'comment' => $data['comment'],'date' => new Carbon($data['date']) ,'is_set' => true, 'doc_type_id' => 1, 'storage_id'=> $data['storage_id'] ]);


        // циклический проход по массиву медикаментов
        foreach ($meds as $med) {

            // получение изменяемой характеристики
            $characteristic = $this->characteristicsRepository->find($med['characteristic_id']);

            // если не найдена характеристика - создаётся новая
            if (empty($characteristic)) {

                // создание цены для характеристики со значением характеристики по умолчанию
                $cp = CharacteristicPrice::create(['price' => $med['sell_price']]);
                if (!$cp) return response(null,500);

                $med['characteristic_price_id'] = $cp->id;
                // добавление новой характеристики
                $characteristic = (new Characteristic())->create($med);
                if (!$characteristic) return response(null,500);

                // добавление значения id характеристики в таблицу Цены характеристик
                $cp->update(['characteristic_id' => $characteristic->id]);

                //создание проводки для регистр накопления
                $wc = (new WareConnection())->create(['storage_id'=> $doc->storage_id, 'characteristic_id' => $characteristic->id,'change' => $med['count']]);
                if (!$wc) return response(null,500);

                // добавление новой проводки документа
                $tableRow = (new FinanceDocumentTableRow())->create(['characteristic_id' => $characteristic->id,
                    'ware_connection_id' =>  $wc->id, 'finance_document_id' => $doc->id,
                    'count' => $med['count'], 'price' => $med['income_price']]);
                if (!$tableRow) return response(null,500);

                continue;
            } // if

            // получение сущности цена характеристики
            $cp = $this->characteristicPricesRepository->find($med['characteristic_price_id']);

            if (empty($cp)) return response(null,204);

            // внесение изменений в характеристику
            $characteristic->update($med);

            // если цена - не та что была раньше
            if($cp->price !== $med['sell_price']) {
                // создание новой цены для характеристики
                $newCp = (new CharacteristicPrice())->create(['price' => $med['sell_price']]);
                if (!$newCp) return response(null,500);

                // обновление цены в характеристике
                $characteristic->update(['characteristic_price_id' => $newCp->id]);
            }

            // поиск строки
            $tableRow = FinanceDocumentTableRow::find($med['id']);
            if (empty($tableRow)) return response(null,204);

            // обновление проводки документа
            $tableRow->update(['count' => $med['count'], 'price' => $med['income_price']]);

            $wc = $this->wareConnectionsRepository->find($tableRow->wareConnection->id);
            if (empty($wc)) return response(null,204);

            //обновление проводки для регистр накопления
            $wc->update(['change' => $med['count']]);

        } // foreach

    } // incomeUpdate


    public function incomeFilter(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $agent_id = $request->input('agent_id');
        $storage_id = $request->input('storage_id');

        $result = $this->financeDocumentsRepository->getFilter($start_date,$end_date, $agent_id, $storage_id);

        return $result->toJson();
    }
}
