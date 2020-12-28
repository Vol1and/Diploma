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

    public function getTable(){
        return Model::all();
    }

    public function find($id){

        //return Model::find($id);
        $columns = [
            'id',
            'name',
            'billing',
            'address',
            'description',
        ];
        return $this->startConditions()->select($columns)->where('id', $id)->get()->first();

    }

    public function getTotalCount(){
        return $this->startConditions()->all()->count();
    }
}
