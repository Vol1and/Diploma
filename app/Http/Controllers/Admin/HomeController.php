<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\OriginController;
use App\Repositories\AgentsRepository;
use App\Repositories\NomenclatureRepository;
use Illuminate\Http\Request;

class HomeController extends OriginController
{
    /**
     * @var NomenclatureRepository
     */
    private $nomenclatureRepository;

    /**
     * @var AgentsRepository
     */
    private $agentsRepository;


    public function __construct()
    {
        parent::__construct();
        $this->nomenclatureRepository = app(NomenclatureRepository::class);
        $this->agentsRepository = app(AgentsRepository::class);
    }

    public function index(){
        $nomenclature_count = $this->nomenclatureRepository->getTotalCount();
        $agents_count = $this->agentsRepository->getTotalCount();

        return view('admin.home.index', [
            'nomenclature_count' => $nomenclature_count,
            'agents_count' => $agents_count,
        ]);
    }
}
