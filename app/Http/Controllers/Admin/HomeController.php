<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\OriginController;
use App\Repositories\AccountingConnectionsRepository;
use App\Repositories\AgentsRepository;
use App\Repositories\NomenclatureRepository;
use App\Repositories\WorkplacesRepository;
use Carbon\Carbon;

class HomeController extends OriginController
{

    private $nomenclatureRepository;
    private $workplacesRepository;
    private $accountingConnectionsRepository;
    private $agentsRepository;


    public function __construct()
    {
        parent::__construct();
        $this->nomenclatureRepository = app(NomenclatureRepository::class);
        $this->agentsRepository = app(AgentsRepository::class);
        $this->workplacesRepository = app(WorkplacesRepository::class);
        $this->accountingConnectionsRepository = app(AccountingConnectionsRepository::class);
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

        // номенклатура принёсшая наибольшую выручку за последние 30 дней
        $most_popular_nomenclature = $this->nomenclatureRepository
            ->findMostPopularNomenclature(Carbon::now()->subDays(30)->toDateString(),Carbon::now()->toDateString());

        // сколько на данный момент открытых смен у пользователей
        $active_user_count = $this->workplacesRepository->how_many_active();
        // кол-во чеков за последние 7 дней
        $last_week_sales_count = $this
            ->accountingConnectionsRepository
            ->findAllSalesByPeriod(Carbon::now()->subDays(7)->toDateString(),Carbon::now()->toDateString());

        return [
            'opened_workplace_count' => $active_user_count,
            'last_week_sales_count' => $last_week_sales_count[0]->counting,
            'most_popular_nomenclature' => $most_popular_nomenclature[0]->nomenclature ];
    }
}
