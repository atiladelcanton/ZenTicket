<?php

namespace App\ProTicket\Contracts;


interface ServiceContract
{
    /**
     * @param string $column
     * @param string $orderColum
     * @return mixed
     */
    public function renderList(string $column = 'id', $orderColum = 'DESC');

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