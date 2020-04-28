<?php


    namespace App\ProTicket\Repositories;

    use App\ProTicket\Models\Project;

    /**
     * Class ProjectRepository
     * @package App\ProTicket\Repositories
     */
    class ProjectRepository extends EloquentRepository
    {
        public function __construct(Project $model)
        {
            parent::__construct($model);
        }
    }
