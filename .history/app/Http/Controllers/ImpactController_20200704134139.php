<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusTicketStore;
use App\ZenTicket\Helpers\LogError;
use App\ZenTicket\Helpers\RegisterNotFound;
use App\ZenTicket\Helpers\SessionFlashMessage;
use App\ZenTicket\Services\ImpactService;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class ImpactController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param ImpactService $impactService
     */
    public function __construct(ImpactService $impactService)
    {
        $this->middleware('auth');
        $this->service = $impactService;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $pageTitle = 'Impactos';
        $impacts = $this->service->renderList();

        return view('dashboard.impact.index', compact('pageTitle', 'impacts'));
    }

    public function create()
    {
        $pageTitle = 'Impactos Novo';

        return view('dashboard.impact.create', compact('pageTitle'));
    }

    /**
     * @param StatusTicketStore $request
     * @return RedirectResponse
     */
    public function store(StatusTicketStore $request)
    {
        try {
            DB::beginTransaction();

            $this->service->buildInsert($request->all());
            DB::commit();
            SessionFlashMessage::success(SessionFlashMessage::STORE);
            return redirect()->route('impactos');
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
            return redirect()->route('impactos');
        }

        $pageTitle = 'Impactos Editar';
        $impact = $this->service->renderEdit($id);
        return view('dashboard.impact.edit', compact('pageTitle', 'impact'));
    }

    public function update($id, StatusTicketStore $request)
    {
        try {
            DB::beginTransaction();

            if (!RegisterNotFound::validate($this->service, $id)) {
                return redirect()->route('impactos');
            }

            $this->service->buildUpdate($id, $request->all());
            DB::commit();
            SessionFlashMessage::success(SessionFlashMessage::UPDATE);
            return redirect()->route('impactos');
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
                return redirect()->route('impactos');
            }
            $this->service->buildDelete($id);
            SessionFlashMessage::success(SessionFlashMessage::DESTROY);
            return redirect()->route('impactos');
        } catch (Exception $e) {
            LogError::Log($e);
            SessionFlashMessage::error(SessionFlashMessage::DESTROY);
            return redirect()->route('impactos');
        }
    }
}
