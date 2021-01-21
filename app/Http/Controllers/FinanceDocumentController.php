<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentCreateRequest;
use App\Models\Characteristic;
use App\Models\CharacteristicPrice;
use App\Models\DocConnection;
use App\Models\FinanceDocument;
use App\Models\FinanceDocumentTableRow;
use App\Models\Ware;
use App\Models\WareConnection;
use App\Repositories\FinanceDocumentsRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FinanceDocumentController extends OriginController
{
    //ссылка на хранилище модели Producer
    private $financeDocumentRepository;

    public function __construct()
    {
        //вызов констракт у родителя
        parent::__construct();

        //инициализация хранилища
        $this->financeDocumentRepository = app(FinanceDocumentsRepository::class);
    }


    public function index()
    {
        return $this->financeDocumentRepository->getTable()->toJson();
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
        $result = $this->financeDocumentRepository->find($id);

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
        $meds = $data['table_rows'];

        //TODO: реализовать вывод ошибки, если массив медикаментов пуст

        // добавление нового документа
        $doc = (new FinanceDocument())->create(['agent_id' => $data['agent_id'],'date' => new Carbon($data['date']) ,'is_set' => true, 'doc_type_id' => 1, 'storage_id'=> $data['storage_id'] ]);

        //todo:Останавливать процесс записи, если какой то из этапов выкидывает ошибку
        // циклический проход по массиву медикаментов
        foreach ($meds as $med) {

            // создание цены для характеристики
            $cp = (new CharacteristicPrice())->create(['price' => $med['sell_price']]);

            // добавление новой характеристики
            $characteristic = (new Characteristic())->create($med + ['characteristic_price_id' => $cp->id]);

            // добавление новой проводки документа
            $tableRow = (new FinanceDocumentTableRow())->create(['characteristic_id' => $characteristic->id, 'finance_document_id' => $doc->id,
                'count' => $med['count'], 'price' => $med['income_price'], 'table_id' => $med['table_id']]);

            //создание проводки для регистр накопления
            $wc = (new WareConnection())->create(['characteristic_id' => $characteristic->id,'change' => $med['count']]);

            // TODO Удалить таблицу остатков, реализовать представление
            // создание записи в остатках, внесение изменений в остатки
            $ware = (new Ware())->create(['characteristic_id' => $characteristic->id, 'stock' => $wc->change]);

        } // foreach
        // return view('deploy', compact('item', 'meds'));
    }


    public function filter($id)
    {
        //
    }
}
