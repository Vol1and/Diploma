<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProducerCreateRequest;
use App\Models\Hotel\Record;
use App\Models\Producer;
use App\Repositories\ProducersRepository;

use Illuminate\Http\Request;

class ProducerController extends Controller
{

    //ссылка на хранилище модели Producer
    private $producerRepository;

    public function __construct()
    {

        //инициализация хранилища
        $this->producerRepository = app(ProducersRepository::class);
    }


    public function index()
    {
        return $this->producerRepository->getTable()->toJson();
    }



    //принимает реквест ProducerCreateRequest
    public function store(ProducerCreateRequest $request)
    {
        //получение данных из реквеста
        $data = $request->input();
        //создание нового продюсера
        $item = new Producer($data);
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
        $result = $this->producerRepository->find($id);

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
    public function update(Request $request, $id)
    {
        $item = $this->producerRepository->find($request->id);
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

}
