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
        public function renderProjectsByAdministrator(){
            return $this->model->select('id','name')->get();
        }
        public function renderProjectsByUser()
        {
            return $this->model->join('project_users', 'project_users.project_id', 'projects.id')
                ->where('project_users.user_id', auth()->user()->id)->select('projects.id','name')->get();

        }
    }
