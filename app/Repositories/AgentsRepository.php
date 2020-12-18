<?php


namespace App\Repositories;
use App\Models\Agent as Model;
use Illuminate\Database\Eloquent\Collection;

class AgentsRepository extends BaseRepository
{

    /**
     * @return string
     */
    public function getModelClass()
    {
        return Model::class;
    }

    /**
     * @return Collection
     */
    public function getForComboBox()
    {
        return $this->startConditions()->all()->except(4);
    }

    public function getTotalCount(){
        return $this->startConditions()->all()->count();
    }
}
