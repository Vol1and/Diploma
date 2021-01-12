<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceTypeCreateRequest;
use App\Models\PriceType;
use App\Repositories\PriceTypesRepository;
use Illuminate\Http\Request;

class PriceTypeController extends OriginController
{
    //ссылка на хранилище модели PriceType
    private $priceTypeRepository;

    public function __construct()
    {

        //инициализация хранилища
        $this->priceTypeRepository = app(PriceTypesRepository::class);
    }


    public function index()
    {
        return $this->priceTypeRepository->getTable()->toJson();
    }



    //принимает реквест с моделью
    public function store(PriceTypeCreateRequest $request)
    {
        //получение данных из реквеста
        $data = $request->input();
        //создание нового элемента
        $item = new PriceType($data);
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
        $result = $this->priceTypeRepository->find($id);

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
    public function update(PriceTypeCreateRequest $request)
    {
        $item = $this->priceTypeRepository->find($request->id);
        if (empty($item)) {

            return response(null, 404);
        }
        $data = $request->all();
        $result = $item->fill($data)->save();

        //todo: подумать над кодом ошибки
        //Что должно вовзращать при ошибке сохранения
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
        $result = PriceType::destroy($id);

        if (!$result) return response(null, 404);

        return response(null, 200);
    }
}
