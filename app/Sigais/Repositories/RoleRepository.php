<?php

namespace App\Sigais\Repositories;

use App\Sigais\Models\Role;

/**
 * Class RoleRepository
 * @package App\Sigais\Repositories
 * @version 1.0.0
 */
class RoleRepository
{
    /**
     * @var Role
     */
    private $model;

    /**
     * Role Repository constructor.
     * @param Role $module
     */
    public function __construct(Role $module)
    {
        $this->model = $module;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->get();
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
        return $this->model->find($id)->fill($data)->save();
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
