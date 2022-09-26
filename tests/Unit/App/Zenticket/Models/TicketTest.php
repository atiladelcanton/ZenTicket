<?php

namespace Unit\App\Zenticket\Models;

use App\ZenTicket\Models\Ticket;
use App\ZenTicket\Models\TypeTicket;
use App\ZenTicket\Models\User;
use App\ZenTicket\Traits\TicketsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Unit\ModelTestCase;

class TicketTest extends ModelTestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateTicket()
    {

        $ticket = factory(Ticket::class)->create();
        $this->assertEquals('Em Espera', $ticket->status);
        $this->assertEquals(null,$ticket->responsible_ticket);
        $this->assertIsString($ticket->ticket_number);
        $this->assertInstanceOf(TypeTicket::class,$ticket->type);
    }

    public function testTicketIsBeingServiced()
    {
        $responsible = factory(User::class)->create();
        $ticket = factory(Ticket::class)->create();
        $ticket->responsible_ticket = $responsible->id;
        $ticket->status = Ticket::COD_STATUS_T;
        $ticket->save();
        $ticket->refresh();
        $this->assertEquals($responsible->id,$ticket->responsible_ticket);
        $this->assertEquals(Ticket::DESC_STATUS_T,$ticket->status);
    }

    public function testTicketIsFinishied()
    {
        $ticket = factory(Ticket::class)->create();
        $ticket->status = Ticket::COD_STATUS_C;
        $ticket->save();
        $ticket->refresh();
        $this->assertEquals($ticket->getStatusAttribute(Ticket::COD_STATUS_C),Ticket::DESC_STATUS_C);
        $this->assertEquals(Ticket::DESC_STATUS_C,$ticket->status);
    }

    public function testTicketIsPaused()
    {
        $ticket = factory(Ticket::class)->create();
        $ticket->status = Ticket::COD_STATUS_P;
        $ticket->save();
        $ticket->refresh();
        $this->assertEquals(Ticket::DESC_STATUS_P,$ticket->status);
    }
    protected function model(): Model
    {
        return new \App\ZenTicket\Models\Ticket();
    }

    protected function traits(): array
    {
        return [
            TicketsTrait::class
        ];
    }

    protected function fillables(): array
    {
        return [
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
    }

    protected function casts(): array
    {
        return [
            "id"=>'int'
        ];
    }
}
