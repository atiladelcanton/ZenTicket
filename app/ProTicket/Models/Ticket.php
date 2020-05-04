<?php


    namespace App\ProTicket\Models;


    use Illuminate\Database\Eloquent\Model;

    /**
     * Class Ticket
     * @package App\ProTicket\Models
     */
    class Ticket extends Model
    {
        const COD_STATUS_E = 'E';
        const COD_STATUS_T = 'T';
        const COD_STATUS_P = 'P';
        const COD_STATUS_AC = 'AC';
        const COD_STATUS_AE = 'AE';
        const COD_STATUS_AT = 'AT';
        const COD_STATUS_TRA = 'ATRA';
        const COD_STATUS_C = 'C';

        const DESC_STATUS_E = 'Em Espera';
        const DESC_STATUS_T = 'Em Tratamento';
        const DESC_STATUS_P = 'Pausado';
        const DESC_STATUS_AC = 'Aguardando Cliente';
        const DESC_STATUS_AE = 'Aguardando Evidencia';
        const DESC_STATUS_AT = 'Aguardando T.I';
        const DESC_STATUS_TRA = 'Atrasado';
        const DESC_STATUS_C = 'Concluído';

        protected $fillable = [
            'sub_ticket_id',
            'type_id',
            'project_id',
            'user_open_ticket',
            'priority_id',
            'role_id',
            'impact_id',
            'status',
            'responsible_ticket',
            'ticket_number',
            'title',
            'description'
        ];

        protected $with = [
            'type',
            'project',
            'userOpen',
            'priority',
            'impact'
        ];

        public function type()
        {
            return $this->hasOne(TypeTicket::class, 'type_id');
        }

        public function project()
        {
            return $this->hasOne(Project::class, 'project_id');
        }

        public function userOpen()
        {
            return $this->hasOne(User::class, 'user_open_ticket');
        }

        public function priority()
        {
            return $this->hasOne(Priority::class, 'priority_id');
        }

        public function impact()
        {
            return $this->hasOne(Impact::class, 'impact_id');
        }
    }
