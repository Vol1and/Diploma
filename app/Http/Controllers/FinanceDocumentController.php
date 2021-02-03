<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentCreateRequest;
use App\Models\FinanceDocument;
use App\Repositories\FinanceDocumentsRepository;
use App\Services\CreateFinanceDocumentService;
use App\Services\UpdateFinanceDocumentService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FinanceDocumentController extends OriginController
{
    //ссылка на хранилище модели Producer
    private $financeDocumentsRepository;
    private $createFinanceDocumentService;
    private $updateFinanceDocumentService;

    public function __construct()
    {
        //вызов констракт у родителя
        parent::__construct();

        //инициализация хранилищ и сервисов
        $this->financeDocumentsRepository = app(FinanceDocumentsRepository::class);
        $this->createFinanceDocumentService = app(CreateFinanceDocumentService::class);
        $this->updateFinanceDocumentService = app(UpdateFinanceDocumentService::class);
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
        if(empty($data)) return response(null,400);

        $meds = $data['table_rows'];
        if(empty($meds)) return response(null,400);

        // добавление нового документа
        $doc = $this->createFinanceDocumentService->createIncome($data,$meds);
        if(empty($doc)) return response(null,500);

        if($request->input('state')) $result = $this->createFinanceDocumentService->pushIncome($doc->id);
        //if(empty($result)) return response(null,500);

    } // incomeCreate


    // метод создания приходного документа
    public function incomeUpdate(DocumentCreateRequest $request, $id)
    {
        // получение данных
        $data = $request->input('item');
        if(empty($data)) return response(null,400);

        $meds = $data['table_rows'];
        if(empty($meds)) return response(null,400);

        $result = $this->updateFinanceDocumentService->updateIncome($data, $meds, $id);
        if(empty($result)) return response(null,500);

        if($request->input('state')) {
            $result = $this->createFinanceDocumentService->pushIncome($id);
            // if(empty($result)) return response(null,500);
        }
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
