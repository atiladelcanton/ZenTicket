<?php

namespace App\ZenTicket\Models;

use App\ZenTicket\Traits\TicketsTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Model UserOneSignal
 * @version 1.0.0
 * @package App\ZenTicket\Models
 */
class ViewTicket extends Model
{
    use TicketsTrait;
    protected $table = 'vw_tickets';



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

    public function getStatusAttribute($value)
    {
        switch ($value) {
            case self::COD_STATUS_E:
                return self::DESC_STATUS_E;
            case self::COD_STATUS_T:
                return self::DESC_STATUS_T;
            case self::COD_STATUS_P:
                return self::DESC_STATUS_P;
            case self::COD_STATUS_AC:
                return self::DESC_STATUS_AC;
            case self::COD_STATUS_AE:
                return self::DESC_STATUS_AE;
            case self::COD_STATUS_AT:
                return self::DESC_STATUS_AT;
            case self::COD_STATUS_TRA:
                return self::DESC_STATUS_TRA;

            default:
                return self::DESC_STATUS_C;
        }
    }
}
