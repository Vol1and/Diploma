<?php

namespace App\Http\Controllers;

use App\Models\Barcode;
use App\Repositories\BarcodesRepository;
use App\Services\CreateBarcodeService;
use Illuminate\Http\Request;

class BarcodeController extends OriginController
{
//ссылка на хранилище модели Barcode
    private $barcodesRepository;

    private $createBarcodeService;

    public function __construct()
    {
        //вызов констракт у родителя
        parent::__construct();

        //инициализация хранилища
        $this->barcodesRepository = app(BarcodesRepository::class);
        $this->createBarcodeService = app(CreateBarcodeService::class);
    }


    public function index()
    {
        return $this->barcodesRepository->getTable()->toJson();
    }



    //принимает реквест с моделью
    public function store(Request $request)
    {
        //получение данных из реквеста
        $data = $request->input();
        $nomenclature_id = $request->input('nomenclature_id');
        $code = $request->input('barcode');

        if($nomenclature_id && $code) {

            $this->createBarcodeService->addNewBarcodeToNomenclature($nomenclature_id, $code);

            //если все ок - возвращаем ответ со статусом 201
            return response(null, 201);

        }

        //если нет - отправляем ошибку (статус возмонжо стоит поменять)
        return response(null,500);

    }

    public function show($id)
    {
        $result = $this->barcodesRepository->find($id);

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
        $item = $this->barcodesRepository->find($request->id);
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
        $result = Barcode::destroy($id);

        if (!$result) return response(null, 404);

        return response(null, 200);
    }
}
