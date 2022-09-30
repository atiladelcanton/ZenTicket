<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusTicketStore;
use App\ZenTicket\Helpers\LogError;
use App\ZenTicket\Helpers\RegisterNotFound;
use App\ZenTicket\Helpers\SessionFlashMessage;
use App\ZenTicket\Services\TypeTicketService;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;

class TypeTicketController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param TypeTicketService $typeTicketService
     */
    public function __construct(TypeTicketService $typeTicketService)
    {
        $this->middleware('auth');
        $this->service = $typeTicketService;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $pageTitle = 'Tipo de Chamados';
        $types = $this->service->renderList();

        return view('dashboard.type_tickets.index', compact('pageTitle', 'types'));
    }

    public function create()
    {
        $pageTitle = 'Tipo de Chamados';

        return view('dashboard.type_tickets.create', compact('pageTitle'));
    }

    public function store(StatusTicketStore $request)
    {
        try {
            DB::beginTransaction();
            $this->service->buildInsert($request->all());
            DB::commit();
            SessionFlashMessage::success(SessionFlashMessage::STORE);
            return redirect()->route('tipos-de-chamados');
        } catch (Exception $e) {
            DB::rollBack();
            LogError::Log($e);
            SessionFlashMessage::error(SessionFlashMessage::STORE);
            return back()->withInput();
        }
    }

    public function edit($id)
    {
        if (!RegisterNotFound::validate($this->service, $id)) {
            return redirect()->route('tipos-de-chamados');
        }

        $pageTitle = 'Tipo de Chamados';
        $type = $this->service->renderEdit($id);
        return view('dashboard.type_tickets.edit', compact('pageTitle', 'type'));
    }

    public function update($id, StatusTicketStore $request)
    {
        try {
            DB::beginTransaction();

            if (!RegisterNotFound::validate($this->service, $id)) {
                return redirect()->route('tipos-de-chamados');
            }

            $this->service->buildUpdate($id, $request->all());
            DB::commit();
            SessionFlashMessage::success(SessionFlashMessage::UPDATE);
            return redirect()->route('tipos-de-chamados');
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

            $this->service->buildDelete($id);
            SessionFlashMessage::success(SessionFlashMessage::DESTROY);
            return redirect()->route('tipos-de-chamados');
        } catch (Exception $e) {
            LogError::Log($e);
            SessionFlashMessage::error(SessionFlashMessage::DESTROY);
            return redirect()->route('status-ticket');
        }
    }
}
