<?php

namespace Tests\Feature\App\Http\Controllers;

use Mockery;
use Exception;
use Tests\TestCase;
use Faker\Generator as Faker;
use Illuminate\Http\Response;
use App\ZenTicket\Models\User;
use App\ZenTicket\Models\TypeTicket;
use App\Http\Requests\StatusTicketStore;

use Illuminate\Foundation\Testing\WithFaker;
use App\ZenTicket\Services\TypeTicketService;
use App\Http\Controllers\TypeTicketController;
use App\ZenTicket\Helpers\SessionFlashMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\ZenTicket\Repositories\TypeTicketRepository;

class TypeTicketControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $controller;
    protected $faker;
    protected $session;
    protected function setUp(): void
    {
        $this->controller = new TypeTicketController(new TypeTicketService(new TypeTicketRepository(new TypeTicket())));
        $this->faker = \Faker\Factory::create();
        $this->session = Mockery::spy(SessionFlashMessage::class);
        parent::setUp();
    }

    public function testIndex()
    {

        factory(TypeTicket::class, 10)->create();

        $return = $this->controller->index();

        $this->assertEquals('Tipo de Chamados', $return->pageTitle);
        $this->assertEquals(10, $return->types->total());
    }

    public function testCreate()
    {
        $return = $this->controller->create();
        $this->assertEquals('Tipo de Chamados', $return->pageTitle);
    }
    public function testStoreSuccess()
    {
        $this->actingAs(factory(User::class)->create());
        $request =  new StatusTicketStore(['name' => 'Category Test']);

        $return = $this->controller->store($request);


        $this->assertDatabaseHas('type_tickets', ['name' => 'Category Test']);
    }

    public function testStoreFailedException()
    {
        $request =  new StatusTicketStore(['name' => $this->faker->sentence(500)]);
        $this->expectException(Exception::class);
        $this->controller->store($request);
    }

    public function testEditSuccess(){
        $typeTycket = factory(TypeTicket::class)->create();

        $return = $this->controller->edit($typeTycket->id);

        $this->assertInstanceOf(TypeTicket::class, $return->type);
        $this->assertEquals($typeTycket->name,$return->type->name);

    }
    public function testUpdateSuccess()
    {
        $typeTycket = factory(TypeTicket::class)->create();
        $request =  new StatusTicketStore(['name' => 'New Category Test']);

        $this->controller->update($typeTycket->id,$request);

        $this->assertDatabaseHas('type_tickets', ['name' => 'New Category Test']);
    }

    public function testUpdateError()
    {
        $typeTycket = factory(TypeTicket::class)->create();
        $request =  new StatusTicketStore(['name' =>  $this->faker->sentence(500)]);
        $this->expectException(Exception::class);
        $this->controller->update($typeTycket->id,$request);


    }

    public function testDeleteSuccess()
    {
        $typeTycket = factory(TypeTicket::class)->create();
        $this->controller->destroy($typeTycket->id);
        $this->assertDatabaseMissing('type_tickets',[
            'id'=>$typeTycket->id,
        ]);

    }
}
