<?php

namespace Tests\Unit\App\Zenticket\Models;

use Tests\Unit\ModelTestCase;
use PHPUnit\Framework\TestCase;
use App\ZenTicket\Models\Ticket;
use App\ZenTicket\Models\Ocurrence;
use Illuminate\Database\Eloquent\Model;
use App\ZenTicket\Models\DocumentOccurrence;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OcurrenceTest extends ModelTestCase
{
    use RefreshDatabase;
    protected function model(): Model {
        return new Ocurrence();
    }

    protected function traits(): array {
        return [];
    }

    protected function fillables(): array {
        return [
            'ticket_id',
            'description',
            'user_id'
        ];
    }

    protected function casts(): array {
        return [
            'id' => 'int'
        ];
    }

    public function testCreateOcurrence(){
        $ocurrence = factory(Ocurrence::class)->create();

        DocumentOccurrence::create([
            'occurrence_id' => $ocurrence->id,
            'extension_document'=> 'png',
            'name'=>'document.png'
        ]);
        $ocurrence->refresh();

        $this->assertInstanceOf(DocumentOccurrence::class,$ocurrence->documentsOccurences[0]);
    }
}
