<?php

namespace App\ZenTicket\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentRepository
 * @package App\ZenTicket\Repositories
 * @version 1.0.0
 */
abstract class EloquentRepository
{
    /**
     * @var Model
     */
    protected $model;


    /**
     * EloquentRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $orderColum
     * @param string $orientation
     * @return mixed
     */
    public function getAll($orderColum = 'id', $orientation = 'desc')
    {

        return $this->model->orderBy($orderColum, $orientation)->paginate(15);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        return $this->model->find($id)->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
}
