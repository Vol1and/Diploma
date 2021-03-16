<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\OriginController;
use App\Repositories\AgentsRepository;
use App\Repositories\NomenclatureRepository;
use App\Repositories\WorkplacesRepository;
use Illuminate\Http\Request;

class HomeController extends OriginController
{

    private $nomenclatureRepository;
    private $workplacesRepository;
    private $agentsRepository;


    public function __construct()
    {
        parent::__construct();
        $this->nomenclatureRepository = app(NomenclatureRepository::class);
        $this->agentsRepository = app(AgentsRepository::class);
        $this->workplacesRepository = app(WorkplacesRepository::class);
    }

    public function index(){
        $nomenclature_count = $this->nomenclatureRepository->getTotalCount();
        $agents_count = $this->agentsRepository->getTotalCount();

        return view('admin_home', [
            'nomenclature_count' => $nomenclature_count,
            'agents_count' => $agents_count,
        ]);
    }

    public function forDashboard(){
        $active_user_count = $this->workplacesRepository->how_many_active();
    }
}
