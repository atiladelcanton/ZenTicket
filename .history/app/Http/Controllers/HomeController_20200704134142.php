<?php

namespace App\Http\Controllers;

use App\ZenTicket\Helpers\LogError;
use App\ZenTicket\Models\Ticket;
use App\ZenTicket\Models\UserOneSignal;
use App\ZenTicket\Services\TicketService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $ticketService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TicketService $ticketService)
    {
        $this->middleware('auth');
        $this->ticketService  = $ticketService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ticketsPending = $this->ticketService->totalTickets(Ticket::COD_STATUS_E);
        $ticketsWorking = $this->ticketService->totalTickets(Ticket::COD_STATUS_T);
        $ticketsFinish = $this->ticketService->totalTickets(Ticket::COD_STATUS_C);
        return view('home', compact('ticketsPending', 'ticketsWorking', 'ticketsFinish'));
    }

    public function registerUserOneSignal(Request $request)
    {
        try {
            UserOneSignal::updateOrCreate(['user_id' => $request->input('user_id')], ['user_id' => $request->input('user_id'), 'device_id' => $request->input('device_id')]);
            return response()->json('oko', 200);
        } catch (\Exception $exception) {
            LogError::Log($exception);
            return response()->json(['data' => 'Ocorreu um problema!'], 500);
        }
    }
}
