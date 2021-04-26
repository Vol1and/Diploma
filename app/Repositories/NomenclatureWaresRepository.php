<?php


namespace App\Repositories;


use App\Models\NomenclatureWare as Model;

class NomenclatureWaresRepository extends BaseRepository
{


    public function getModelClass()
    {
        return Model::class;
    }

    public function getTableByStorage($storage_id, $name)
    {

        $query = $this->startConditions()
            ->select('*')
            ->with(['nomenclature', 'storage'])
            ->where('storage_id','=',$storage_id);

       if ($name)
           $query = $query->where('name', 'like', $name);

        $result = $query->get();


        return $result;
    }


    public function getFilter($storage_id, $nomenclature_id)
    {

        $query = $this->startConditions()
            ->select('*')
            ->with(['characteristic', 'storage', 'characteristic.nomenclature']);

        if ($storage_id)
            $query = $query->where('storage_id', 'like', $storage_id);

        if ($nomenclature_id)
            $query = $query->whereHas('characteristic.nomenclature', function($query)use($nomenclature_id) {
                $query->where('nomenclature_id', 'like', $nomenclature_id);

            });

        return $query->get();

    }
}
