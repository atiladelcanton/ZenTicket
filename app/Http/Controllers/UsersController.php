<?php


namespace App\Http\Controllers;


use App\Http\Requests\UserStore;
use App\ProTicket\Helpers\LogError;
use App\ProTicket\Helpers\SessionFlashMessage;
use App\ProTicket\Services\ProjectService;
use App\ProTicket\Services\RoleService;
use App\ProTicket\Services\UserService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

/**
 * Class UsersController
 * @package App\Http\Controllers
 * @version 1.0.0
 */
class UsersController extends Controller
{
    private $userService;
    private $roleService;
    private $projectService;
    public function __construct(UserService $userService, RoleService $roleService, ProjectService $projectService)
    {
        $this->middleware('auth');
        $this->userService = $userService;
        $this->roleService = $roleService;
        $this->projectService = $projectService;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $users = $this->userService->renderList();
        $pageTitle = 'Usuários';
        return view('dashboard.user.index', compact('users', 'pageTitle'));
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $roles = $this->roleService->renderList();
        $projects = $this->projectService->renderList();
        $pageTitle = 'Usuários';
        return view('dashboard.user.create', compact('roles', 'pageTitle', 'projects'));
    }

    /**
     * @param UserStore $request
     * @return RedirectResponse
     */
    public function store(UserStore $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();

            $this->userService->buildInsert($data);
            DB::commit();
            $request->session()->flash('message', ['type' => 'Success', 'msg' => __('messages.success_store')]);
            return redirect()->route('usuarios');
        } catch (Exception $e) {
            DB::rollBack();
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

    /**
     * @param $id
     * @return Factory|RedirectResponse|View
     */
    public function edit($id)
    {
        try {
            $user = $this->userService->renderEdit($id);
            $roles = $this->roleService->renderList();
            $projects = $this->projectService->renderList();


            $pageTitle = 'Usuários';
            return view('dashboard.user.edit', compact('user', 'roles', 'pageTitle', 'projects'));
        } catch (Exception $e) {
            LogError::Log($e);
            SessionFlashMessage::error(SessionFlashMessage::STORE);
            return redirect()->route('usuarios');
        }
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();

            $this->userService->buildUpdate($id, $data);
            DB::commit();
            $request->session()->flash('message', ['type' => 'Success', 'msg' => __('messages.success_update')]);
            return redirect()->route('usuarios');
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
            $user = $this->userService->renderEdit($id);
            if (is_null($user)) {
                SessionFlashMessage::error(SessionFlashMessage::DESTROY);
                return redirect()->route('usuarios');
            }

            $this->userService->buildDelete($id);
            session()->flash('message', ['type' => 'Success', 'msg' => __('messages.success_destroy')]);
            return redirect()->route('usuarios');
        } catch (Exception $e) {
            LogError::Log($e);
            SessionFlashMessage::error(SessionFlashMessage::DESTROY);
            return redirect()->route('usuarios');
        }
    }
}
