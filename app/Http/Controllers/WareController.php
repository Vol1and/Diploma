<?php

namespace App\Http\Controllers;

use App\Models\Nomenclature;
use App\Models\Storage;
use App\Repositories\NomenclatureWaresRepository;
use App\Repositories\WaresRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class WareController extends Controller
{
    private $waresRepository;
    private $nomenclatureWaresRepository;

    public function __construct()
    {

        //инициализация хранилища
        $this->waresRepository = app(WaresRepository::class);
        $this->nomenclatureWaresRepository = app(NomenclatureWaresRepository::class);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->waresRepository->getTable()->toJSON();
    }

    public function getNomenclatureWares(Request $request)
    {

        // return $result->toJson();
    }


    public function filterCashierPlace(Request $request)
    {
        $storage_id = $request->input('storage_id');
        $name = $request->input('name');

        $result = $this->nomenclatureWaresRepository->getTableByStorage($storage_id,'%' . $name . '%');

        return $result->toJson();
    }

    public function getFilter(Request $request)
    {

        $storage_id = $request->input('storage_id');
        $nomenclature_id = $request->input('nomenclature_id');

        // $result = $this->financeDocumentsRepository->getFilter($start_date,$end_date, $agent_id, $storage_id);
        return $this->waresRepository->getFilter($storage_id, $nomenclature_id)->toJSON();
        // return $result->toJson();
    }

    public function report($nomenclature_id, $storage_id)
    {
        if ($storage_id == 0) $storage_id = null;
        if ($nomenclature_id == 0) $nomenclature_id = null;



        $item = $this->waresRepository->getFilter($storage_id, $nomenclature_id);

        $pdf = PDF::loadView('pdfs.wares', ['items' => $item, 'storage' => Storage::find($storage_id), 'nomenclature' => Nomenclature::find($nomenclature_id)]);

        return $pdf->download('Остатки товаров ' . Carbon::now() . '.pdf');

    }

}
