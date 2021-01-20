<?php


namespace App\Repositories;

use App\Models\Producer as Model;

class ProducersRepository extends BaseRepository
{

    public function getModelClass()
    {
        return Model::class;
    }

    public function getTable()
    {
        return Model::all();
    }

    public function find($id)
    {
        //return Model::find($id);
        $columns = [
            'id',
            'name',
            'country'
        ];
        return $this->startConditions()->select($columns)->where('id', $id)->get()->first();

    }

    public function getFilter($name = null, $country = null)
    {

        $columns = [
            'id',
            'name',
            'country'
        ];


        $query = $this->StartConditions()
            ->select($columns);


        if ($name)
            $query = $query->where('name', 'like', $name);

        if ($country)
            $query = $query->where('country', 'like', $country);

        return $query->get();


    }
}
