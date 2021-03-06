<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusTicketStore;
use App\ZenTicket\Helpers\LogError;
use App\ZenTicket\Helpers\RegisterNotFound;
use App\ZenTicket\Helpers\SessionFlashMessage;
use App\ZenTicket\Services\ProjectService;
use App\ZenTicket\Services\UserService;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    private $service;
    private $userService;
    /**
     * Create a new controller instance.
     *
     * @param ProjectService $project
     */
    public function __construct(ProjectService $project, UserService $userService)
    {
        $this->middleware('auth');
        $this->service = $project;
        $this->userService = $userService;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $pageTitle = 'Projetos';
        $projects = $this->service->renderList();

        return view('dashboard.project.index', compact('pageTitle', 'projects'));
    }

    public function create()
    {
        $pageTitle = 'Projetos Novo';
        $users = $this->userService->renderList();

        return view('dashboard.project.create', compact('pageTitle', 'users'));
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
            return redirect()->route('projetos');
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
            return redirect()->route('projetos');
        }

        $pageTitle = 'Projetos Editar';
        $project = $this->service->renderEdit($id);
        $users = $this->userService->renderList();

        return view('dashboard.project.edit', compact('pageTitle', 'project', 'users'));
    }

    public function update($id, StatusTicketStore $request)
    {
        try {
            DB::beginTransaction();

            if (!RegisterNotFound::validate($this->service, $id)) {
                return redirect()->route('projetos');
            }

            $this->service->buildUpdate($id, $request->all());
            DB::commit();
            SessionFlashMessage::success(SessionFlashMessage::UPDATE);
            return redirect()->route('projetos');
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
                return redirect()->route('projetos');
            }
            $this->service->buildDelete($id);
            SessionFlashMessage::success(SessionFlashMessage::DESTROY);
            return redirect()->route('projetos');
        } catch (Exception $e) {
            LogError::Log($e);
            SessionFlashMessage::error(SessionFlashMessage::DESTROY);
            return redirect()->route('projetos');
        }
    }
}
