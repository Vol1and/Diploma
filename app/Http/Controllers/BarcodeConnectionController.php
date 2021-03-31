<?php

namespace App\Http\Controllers;

use App\Models\BarcodeConnection;
use App\Repositories\BarcodeConnectionsRepository;
use App\Services\CreateBarcodeService;
use Illuminate\Http\Request;

class BarcodeConnectionController extends OriginController
{
//ссылка на хранилище модели Barcode
    private $barcodeConnectionsRepository;
    private $createBarcodeService;

    public function __construct()
    {
        //вызов констракт у родителя
        parent::__construct();

        //инициализация хранилища
        $this->barcodeConnectionsRepository = app(BarcodeConnectionsRepository::class);
        $this->createBarcodeService = app(CreateBarcodeService::class);
    }


    public function index()
    {
        return $this->barcodeConnectionsRepository->getTable();
    }


    //принимает реквест с моделью
    public function store(Request $request)
    {
        //получение данных из реквеста
        //создание нового элемента
        $barcode = $this->createBarcodeService->make(['code' => $request->input('barcode')]);
        $item = $this->createBarcodeService->makeConnection(['barcode_id' => $barcode->id, 'nomenclature_id' => $request->input('nomenclature_id')]);

        //если все ок - возвращаем ответ со статусом 201
        if($item)
            return response(null, 201);

        //если нет - отправляем ошибку (статус возмонжо стоит поменять)
        return response(null,500);
    }

    public function show($id)
    {
        $result = $this->barcodeConnectionsRepository->find($id);

        if(empty($result) || !$result){

            return response(null, 404);
        }
        return $result->toJson();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $item = $this->barcodeConnectionsRepository->find($request->id);
        if (empty($item)) {

            return response(null, 404);
        }
        $data = $request->all();
        $result = $item->fill($data)->save();

        if (!$result) {
            return response(null, 404);
        }
        else  return response(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = BarcodeConnection::destroy($id);

        if (!$result) return response(null, 404);

        return response(null, 200);
    }
    public function getFilter(Request $request)
    {


        $nomenclature_id = $request->input('nomenclature_id');

       return $this->barcodeConnectionsRepository->findByNomenclature( $nomenclature_id)->toJSON();

    }
}
