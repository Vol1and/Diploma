<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Repositories\AgentsRepository;
use Illuminate\Http\Request;

class AgentController extends OriginController
{
    //ссылка на хранилище модели Agent
    private $agentRepository;

    public function __construct()
    {

        //инициализация хранилища
        $this->agentRepository = app(AgentsRepository::class);
    }


    public function index()
    {
        return $this->agentRepository->getTable()->toJson();
    }



    //принимает реквест с моделью
    public function store(Request $request)
    {
        //получение данных из реквеста
        $data = $request->input();
        //создание нового элемента
        $item = new Agent($data);
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
        $result = $this->agentRepository->find($id);

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
        $item = $this->agentRepository->find($request->id);
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
        $result = Agent::destroy($id);

        if (!$result) return response(null, 404);

        return response(null, 200);
    }
}
