<?php

namespace App\Http\Controllers;

use App\Repositories\CharacteristicsRepository;
use App\Repositories\NomenclatureRepository;
use Illuminate\Http\Request;

class CharacteristicController extends OriginController
{


    //ссылка на хранилище модели PriceType
    private $characteristicRepository;

    private $nomenclatureRepository;
    public function __construct()
    {

        //инициализация хранилища
        $this->characteristicRepository = app(CharacteristicsRepository::class);
        $this->nomenclatureRepository = app(NomenclatureRepository::class);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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

    public function forNomenclature($id){



        $nomenclature = $this->nomenclatureRepository->find($id);
        $characteristics = $this->characteristicRepository->getCharacteristicsByNomenclatureId($id);

        return ['nomenclature'=>$nomenclature, 'characteristics' => $characteristics];
    }
}
