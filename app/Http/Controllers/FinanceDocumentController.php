<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentCreateRequest;
use App\Models\FinanceDocument;
use App\Repositories\AccountingConnectionsRepository;
use App\Repositories\FinanceDocumentsRepository;
use App\Services\CreateFinanceDocumentService;
use App\Services\UpdateFinanceDocumentService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PDF;


class FinanceDocumentController extends OriginController
{
    //ссылка на хранилище модели Producer
    private $financeDocumentsRepository;
    private $createFinanceDocumentService;
    private $updateFinanceDocumentService;
    private $accountRep;

    public function __construct()
    {
        //вызов констракт у родителя
        parent::__construct();

        //инициализация хранилищ и сервисов
        $this->financeDocumentsRepository = app(FinanceDocumentsRepository::class);
        $this->accountRep = app(AccountingConnectionsRepository::class);
        $this->createFinanceDocumentService = app(CreateFinanceDocumentService::class);
        $this->updateFinanceDocumentService = app(UpdateFinanceDocumentService::class);
    }


    public function index()
    {
        return $this->financeDocumentsRepository->getByDocTypeId(1)->toJson();
    }

    public function getSellings()
    {
        return $this->financeDocumentsRepository->getByDocTypeId(2)->toJson();
    }

    //public function sell(Request $request)
    //{
    //    return $request;
    //}

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
        $result = $this->updateFinanceDocumentService->deleteFinanceDoc($id);

        if ($result)
        return response(['msg' => "Документ успешно удалён"], 200);
        else return response(['error' => "Ошибка удаления"], 500);
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
        $doc = $this->createFinanceDocumentService->createFinanceDoc($data,$meds);
        if(empty($doc)) return response(null,500);


        if($request->input('state')) $result = $this->createFinanceDocumentService->pushFinanceDoc($doc->id);
        //if(empty($result)) return response(null,500);

    } // incomeCreate


    // метод создания приходного документа
    public function incomeUpdate(DocumentCreateRequest $request, $id)
    {
        // получение данных
        $data = $request->input('item');
        if(empty($data)) return response(null,400);

        $deleted = $data['deleted_rows'];

        $updated = $data['updated_rows'];


        $result = $this->updateFinanceDocumentService->updateIncome($data, $deleted, $updated, $id);

        if(empty($result)) return response(null,500);

        if($request->input('state')) {
            $result = $this->createFinanceDocumentService->pushFinanceDoc($id);
            // if(empty($result)) return response(null,500);
        }
        return response(null,200);
    } // incomeUpdate


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sell(Request $request)
    {
        // получение данных
        $data = [
            'user_id'=> $request->input('user_id'),
            'workplace_id' => $request->input('workplace_id'),
            'doc_sum' => $request->input('doc_sum')
            ];

        if(empty($data)) return response(null,400);

        $meds = $request->input('items');
        if(empty($meds)) return response(null,400);

        // добавление нового документа
        $doc = $this->createFinanceDocumentService->createFinanceDoc($data,$meds);
        if(empty($doc)) return response(null,500);


        $result = $this->createFinanceDocumentService->pushFinanceDoc($doc->id);
        if(empty($result)) return response(null,500);

    }


    public function incomeFilter(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $agent_id = $request->input('agent_id');
        $storage_id = $request->input('storage_id');

        $result = $this->financeDocumentsRepository->getFilter($start_date,$end_date, $agent_id, $storage_id);

        return $result->toJson();
    }

    public function incomeReports( $id, $mode){

        //return true;
        $item = $this->financeDocumentsRepository->find($id);
        $pdf = PDF::loadView('pdfs.documents.income.main',
            ['item' => $item]);

        return $pdf->download('Поступление_№_'.$item->id.'.pdf');
    }

    public function sellingReports( $id, $mode){

        switch ($mode){
            case "main":
                $item = $this->financeDocumentsRepository->find($id);
                $pdf = PDF::loadView('pdfs.documents.selling.main',
                    ['item' => $item]);

                return $pdf->download('Реализация_№_'.$item->id.'.pdf');
            case "check":
                $item = $this->financeDocumentsRepository->find($id);
                $pdf = PDF::loadView('pdfs.documents.selling.check',
                    ['item' => $item]);

                return $pdf->download('Чек №_'.$item->id.'.pdf');

        }
        //return true;

    }
}

