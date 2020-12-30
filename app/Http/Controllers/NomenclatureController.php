<?php

namespace App\Http\Controllers;

use App\Http\Requests\NomenclatureCreateRequest;
use App\Models\Nomenclature;
use App\Repositories\NomenclatureRepository;
use Illuminate\Http\Request;

class NomenclatureController extends OriginController
{
    //ссылка на хранилище модели PriceType
    private $nomenclatureRepository;

    public function __construct()
    {

        //инициализация хранилища
        $this->nomenclatureRepository = app(NomenclatureRepository::class);
    }


    public function index()
    {
        return $this->nomenclatureRepository->getTable()->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NomenclatureCreateRequest $request)
    {
        //получение данных из реквеста
        $data = $request->input();
        //создание нового элемента
        $item = new Nomenclature($data);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->nomenclatureRepository->find($id);

        if(empty($result) || !$result){

            return response(null, 404);
        }
        return $result->toJson();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NomenclatureCreateRequest $request)
    {

        $item = $this->nomenclatureRepository->find($request->id);
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
        //
    }


   //public function whenLastUpdate(){
//
   //    return $this->nomenclatureRepository->getLastUpdated()->updated_at;
   //}

    public function filter(Request $request)
    {

        $name = $request->input('name');
        $producer_id = $request->input('producer_id');
        $price_type_id = $request->input('price_type_id');

        $result = $this->nomenclatureRepository->getFilter('%' . $name . '%',   $producer_id, $price_type_id);

        return $result->toJson();
    }
}
