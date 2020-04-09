<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleStore;
use App\Sigais\Services\ModuloService;
use App\Sigais\Services\RoleService;
use Illuminate\Support\Facades\Log;

class RolesController extends Controller
{
    private $roleServices;
    private $moduleService;

    /**
     * Create a new controller instance.
     *
     * @param  RoleService  $roleService
     * @param  ModuloService  $moduloService
     */
    public function __construct(RoleService $roleService, ModuloService $moduloService)
    {
        $this->middleware('auth');
        $this->roleServices = $roleService;
        $this->moduleService = $moduloService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pageTitle = 'Grupos';
        $roles = $this->roleServices->renderList();

        return view('dashboard.groups.index', compact('pageTitle', 'roles'));
    }

    public function create()
    {
        $pageTitle = 'Novo Grupo';

        $modules = $this->moduleService->renderWithPermission(auth()->user()->roles[0]->id);
        return view('dashboard.groups.create', compact('pageTitle', 'modules'));
    }

    public function store(RoleStore $request)
    {
        try {
            $data = $request->all();
            if (!isset($data['permissions'])) {
                $request->session()->flash('message', ['type' => 'Warning', 'msg' => __('messages.permissions_required')]);

                return back()->withInput();
            }
            $this->roleServices->buildInsert($data);
            $request->session()->flash('message', ['type' => 'Success', 'msg' => __('messages.success_store')]);
            return redirect()->route('grupos');
        } catch (\Exception $e) {
            Log::error(
                $e->getMessage(),
                [
                    'usuario' => auth()->user()->email,
                    'linha' => $e->getLine(),
                    'arquivo' => $e->getFile(),
                ]
            );
            $request->session()->flash('message', ['type' => 'Error', 'msg' => __('messages.catch_message_store')]);

            return back()->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $dataEdit = $this->roleServices->renderEdit($id);

            if (is_null($dataEdit['role'])) {
                session()->flash('message', ['type' => 'Warning', 'msg' => __('messages.not_found')]);
                return redirect()->route('grupos');
            }
            $pageTitle = 'Editar Grupo';
            $role = $dataEdit['role'];
            $permissions = $dataEdit['permissions'];
            $modules = $this->moduleService->renderWithPermission(auth()->user()->roles[0]->id);

            return view('dashboard.groups.edit', compact('pageTitle', 'modules', 'role','permissions'));
        } catch (\Exception $e) {
            Log::error(
                $e->getMessage(),
                [
                    'usuario' => auth()->user()->email,
                    'linha' => $e->getLine(),
                    'arquivo' => $e->getFile(),
                ]
            );

            session()->flash('message', ['type' => 'Error', 'msg' => __('messages.catch_message_store')]);

            return redirect()->route('grupos');
        }
    }
    
    public function update($id,RoleStore $request){
        try {

            $data = $request->all();
            if (!isset($data['permissions'])) {
                $request->session()->flash('message', ['type' => 'Warning', 'msg' => __('messages.permissions_required')]);

                return back()->withInput();
            }
            $this->roleServices->buildUpdate($id,$data);
            $request->session()->flash('message', ['type' => 'Success', 'msg' => __('messages.success_update')]);
            return redirect()->route('grupos');
        } catch (\Exception $e) {
            Log::error(
                $e->getMessage(),
                [
                    'usuario' => auth()->user()->email,
                    'linha' => $e->getLine(),
                    'arquivo' => $e->getFile(),
                ]
            );
            $request->session()->flash('message', ['type' => 'Error', 'msg' => __('messages.catch_message_update')]);

            return back()->withInput();
        }
    }
}
