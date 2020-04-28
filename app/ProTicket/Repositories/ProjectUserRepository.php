<?php


    namespace App\ProTicket\Repositories;

    use App\ProTicket\Models\ProjectUser;

    /**
     * Class ProjectUserRepository
     * @package App\ProTicket\Repositories
     */
    class ProjectUserRepository extends EloquentRepository
    {
        public function __construct(ProjectUser $model)
        {
            parent::__construct($model);
        }
    }
