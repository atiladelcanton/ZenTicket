<?php

namespace App\ZenTicket\Repositories;


use App\ZenTicket\Models\User;

/**
 * Class UserRepository
 * @package App\ZenTicket\Repositories
 * @version 1.0.0
 */
class UserRepository
{
    /**
     * @var Role
     */
    private $model;

    /**
     * User Repository constructor.
     * @param User $module
     */
    public function __construct(User $module)
    {
        $this->model = $module;
    }

    /**
     * retrieve all users
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->get();
    }

    /**
     * retrieve a user
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * inserts a user
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        return $this->model->find($id)->fill($data)->save();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->model->find($id)->delete();
    }
}
