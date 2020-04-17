<?php

namespace App\ProTicket\Contracts;


interface ServiceContract
{
    /**
     * @return mixed
     */
    public function renderList();

    /**
     * @param int $id
     * @return mixed
     */
    public function renderEdit(int $id);

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function buildUpdate(int $id, array $data);

    /**
     * @param array $data
     * @return mixed
     */
    public function buildInsert(array $data);

    /**
     * @param int $id
     * @return mixed
     */
    public function buildDelete(int $id);


}