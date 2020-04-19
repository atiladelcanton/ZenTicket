<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriorityStore;
use App\Http\Requests\StatusTicketStore;
use App\ProTicket\Helpers\LogError;
use App\ProTicket\Helpers\RegisterNotFound;
use App\ProTicket\Helpers\SessionFlashMessage;
use App\ProTicket\Services\PriorityService;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;

class PriorityController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param PriorityService $priorityService
     */
    public function __construct(PriorityService $priorityService)
    {
        $this->middleware('auth');
        $this->service = $priorityService;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $pageTitle = 'Prioridades';
        $priorities = $this->service->renderList();

        return view('dashboard.priority.index', compact('pageTitle', 'priorities'));
    }

    public function create()
    {
        $pageTitle = 'Prioridades';

        return view('dashboard.priority.create', compact('pageTitle'));
    }

    public function store(PriorityStore $request)
    {
        try {
            DB::beginTransaction();
            $this->service->buildInsert($request->all());
            DB::commit();
            SessionFlashMessage::success(SessionFlashMessage::STORE);
            return redirect()->route('prioridade');
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
            return redirect()->route('prioridade');
        }

        $pageTitle = 'Prioridades';
        $priority = $this->service->renderEdit($id);
        return view('dashboard.priority.edit', compact('pageTitle', 'priority'));
    }

    public function update($id, StatusTicketStore $request)
    {
        try {
            DB::beginTransaction();

            if (!RegisterNotFound::validate($this->service, $id)) {
                return redirect()->route('prioridade');
            }

            $this->service->buildUpdate($id, $request->all());
            DB::commit();
            SessionFlashMessage::success(SessionFlashMessage::UPDATE);
            return redirect()->route('prioridade');
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
            if (!RegisterNotFound::validate($this->service, $id)) {
                return redirect()->route('prioridade');
            }

            $this->service->buildDelete($id);
            SessionFlashMessage::success(SessionFlashMessage::DESTROY);
            return redirect()->route('prioridade');
        } catch (Exception $e) {
            LogError::Log($e);
            SessionFlashMessage::error(SessionFlashMessage::DESTROY);
            return redirect()->route('status-ticket');
        }
    }
}
