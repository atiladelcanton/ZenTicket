<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusTicketStore;
use App\ProTicket\Helpers\LogError;
use App\ProTicket\Helpers\SessionFlashMessage;
use App\ProTicket\Services\StatusTicketService;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;

class StatusTicketController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param StatusTicketService $statusTicketService
     */
    public function __construct(StatusTicketService $statusTicketService)
    {
        $this->middleware('auth');
        $this->service = $statusTicketService;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $pageTitle = 'Status Ticket';
        $status = $this->service->renderList();

        return view('dashboard.status_ticket.index', compact('pageTitle', 'status'));
    }

    public function create()
    {
        $pageTitle = 'Status Ticket';

        return view('dashboard.status_ticket.create', compact('pageTitle'));
    }

    public function store(StatusTicketStore $request)
    {
        try {
            DB::beginTransaction();

            $this->service->buildInsert($request->all());
            DB::commit();
            SessionFlashMessage::success(SessionFlashMessage::STORE);
            return redirect()->route('status-ticket');
        } catch (Exception $e) {
            DB::rollBack();
            LogError::Log($e);

            SessionFlashMessage::error(SessionFlashMessage::STORE);
            return back()->withInput();
        }
    }

    public function edit($id)
    {
        $status = $this->service->renderEdit($id);

        if (is_null($status)) {
            session()->flash('message', ['type' => 'Error', 'msg' => __('messages.not_found')]);
            return redirect()->route('status-ticket');
        }

        $pageTitle = 'Status Ticket';
        $status = $this->service->renderEdit($id);
        return view('dashboard.status_ticket.edit', compact('pageTitle', 'status'));
    }

    public function update($id, StatusTicketStore $request)
    {
        try {
            DB::beginTransaction();
            $status = $this->service->renderEdit($id);

            if (is_null($status)) {
                session()->flash('message', ['type' => 'Error', 'msg' => __('messages.not_found')]);
                return redirect()->route('status-ticket');
            }
            $this->service->buildUpdate($id, $request->all());
            DB::commit();
            SessionFlashMessage::success(SessionFlashMessage::UPDATE);
            return redirect()->route('status-ticket');
        } catch (Exception $e) {
            DB::rollBack();
            LogError::Log($e);

            SessionFlashMessage::error(SessionFlashMessage::UPDATE);
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $status = $this->service->renderEdit($id);

            if (is_null($status)) {
                session()->flash('message', ['type' => 'Error', 'msg' => __('messages.not_found')]);
                return redirect()->route('status-ticket');
            }

            $this->service->buildDelete($id);
            SessionFlashMessage::success(SessionFlashMessage::DESTROY);
            return redirect()->route('status-ticket');
        } catch (Exception $e) {
            LogError::Log($e);
            SessionFlashMessage::error(SessionFlashMessage::DESTROY);
            return redirect()->route('status-ticket');
        }
    }
}
