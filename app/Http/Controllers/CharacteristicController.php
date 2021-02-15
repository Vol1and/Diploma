<?php

namespace App\Http\Controllers;

use App\Repositories\ButchWaresRepository;
use App\Repositories\CharacteristicsRepository;
use App\Repositories\NomenclatureRepository;
use App\Repositories\StoragesRepository;
use App\Services\CreateCharacteristicService;
use Illuminate\Http\Request;

class CharacteristicController extends OriginController
{


    //ссылка на хранилище модели PriceType
    private $characteristicRepository;
    private $createCharacteristicService;
    private $nomenclatureRepository;
    private $storageRepository;
    private $butchWaresRepository;

    public function __construct()
    {

        //инициализация хранилища
        $this->characteristicRepository = app(CharacteristicsRepository::class);
        $this->createCharacteristicService = app(CreateCharacteristicService::class);
        $this->nomenclatureRepository = app(NomenclatureRepository::class);
        $this->storageRepository = app(StoragesRepository::class);
        $this->butchWaresRepository = app(ButchWaresRepository::class);
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
     * @param int $nomenclature_id Айди номенклатуры, на которую создается характеристика
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $nomenclature_id)
    {
        $result = $this->nomenclatureRepository->find($nomenclature_id);
        if (empty($result))
            return response("Номенклатура с выбранным id не найдена!", 500);

        //получение данных из реквеста
        $data = $request->input();
        //создание нового элемента
        // $item = new Characteristic(['expiry_date'=> $data['expiry_date'],'serial'=> $data['serial'], 'nomenclature_id' => $nomenclature_id ]);

        $item = $this->createCharacteristicService->add(['nomenclature_id' => $nomenclature_id] + $data);

        //сохраняем
        // $item->save();

        //если все ок - возвращаем ответ со статусом 201
        if ($item)
            return response(null, 201);
        //либо можно передавать айди созданного элемента
        //return response($item->id, 201);

        //если нет - отправляем ошибку (статус возмонжо стоит поменять)
        return response(null, 500);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAllByNomenclatureId($id)
    {


        $nomenclature = $this->nomenclatureRepository->find($id);
        $characteristics = $this->characteristicRepository->getAllByNomenclatureId($id);

        return ['nomenclature' => $nomenclature, 'characteristics' => $characteristics];
    }

    public function getAllByNomenclatureAndStorageIdWithWares($nomenclature_id, $storage_id)
    {


        $nomenclature = $this->nomenclatureRepository->find($nomenclature_id);
        if (empty($nomenclature)) return response('Выбранная номенклатура не найдена', 500);

        $storage = $this->storageRepository->find($storage_id);
        if (empty($storage)) return response('Выбранный склад не найден', 500);

        $characteristics = $this->characteristicRepository->getAllByNomenclatureAndStorageIdWithWares($nomenclature_id, $storage_id);

        //$butch_wares = $this->butchWaresRepository->getByNomenclatureAndStorage();
        return ['nomenclature' => $nomenclature, 'storage' => $storage, 'characteristics' => $characteristics];
    }
}
