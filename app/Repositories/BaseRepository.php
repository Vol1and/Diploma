<?php


namespace App\Repositories;


abstract class BaseRepository
{


    protected $model;


    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     */
    abstract public function getModelClass();

    protected function StartConditions(){
        return clone $this->model;
    }
 }
