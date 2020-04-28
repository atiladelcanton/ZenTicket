<?php

namespace App\Http\Controllers;

use App\ProTicket\Helpers\LogError;
use App\ProTicket\Helpers\SessionFlashMessage;
use App\ProTicket\Services\ModuloService;
use App\ProTicket\Services\RoleService;
use App\Http\Requests\RoleStore;
use Exception;
use Illuminate\Contracts\Support\Renderable;

class RolesController extends Controller
{
    private $roleServices;
    private $moduleService;
    private $pageTitle;

    /**
     * Create a new controller instance.
     *
     * @param RoleService $roleService
     * @param ModuloService $moduloService
     */
    public function __construct(RoleService $roleService, ModuloService $moduloService)
    {
        $this->middleware('auth');
        $this->roleServices = $roleService;
        $this->moduleService = $moduloService;
        $this->pageTitle = 'Grupos';
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $pageTitle = $this->pageTitle;
        $roles = $this->roleServices->renderList();

        return view('dashboard.groups.index', compact('pageTitle', 'roles'));
    }

    public function create()
    {
        $pageTitle = $this->pageTitle;

        $modules = $this->moduleService->renderList(auth()->user()->role_id);

        return view('dashboard.groups.create', compact('pageTitle', 'modules'));
    }

    public function store(RoleStore $request)
    {
        try {
            $data = $request->all();
            if (!isset($data['permissions'])) {
                $request->session()->flash(
                    'message',
                    ['type' => 'Warning', 'msg' => __('messages.permissions_required')]
                );

                return back()->withInput();
            }
            $this->roleServices->buildInsert($data);
            SessionFlashMessage::success(SessionFlashMessage::STORE);
            return redirect()->route('grupos');
        } catch (Exception $e) {
            LogError::Log($e);

            SessionFlashMessage::error(SessionFlashMessage::STORE);
            return back()->withInput();
        }
    }

    public function edit($id)
    {
        $dataEdit = $this->roleServices->renderEdit($id);

        if (is_null($dataEdit['role'])) {
            session()->flash('message', ['type' => 'Warning', 'msg' => __('messages.not_found')]);
            return redirect()->route('grupos');
        }
        $pageTitle = $this->pageTitle;
        $role = $dataEdit['role'];
        $permissions = $dataEdit['permissions'];

        $modules = $this->moduleService->renderList(auth()->user()->role_id);

        return view('dashboard.groups.edit', compact('pageTitle', 'modules', 'role', 'permissions'));
    }

    public function update($id, RoleStore $request)
    {
        try {
            $data = $request->all();
            if (!isset($data['permissions'])) {
                $request->session()->flash(
                    'message',
                    ['type' => 'Warning', 'msg' => __('messages.permissions_required')]
                );

                return back()->withInput();
            }
            $this->roleServices->buildUpdate($id, $data);
            SessionFlashMessage::success(SessionFlashMessage::UPDATE);
            return redirect()->route('grupos');
        } catch (Exception $e) {
            LogError::Log($e);
            SessionFlashMessage::error(SessionFlashMessage::UPDATE);
            return back()->withInput();
        }
    }
}
