<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusTicketStore;
use App\Http\Requests\TicketStore;
use App\ProTicket\Helpers\LogError;
use App\ProTicket\Helpers\RegisterNotFound;
use App\ProTicket\Helpers\SessionFlashMessage;
use App\ProTicket\Helpers\Upload;
use App\ProTicket\Models\TimeLineTicket;
use App\ProTicket\Services\ImpactService;
use App\ProTicket\Services\PriorityService;
use App\ProTicket\Services\ProjectService;
use App\ProTicket\Services\Specializations\CalculateHoursWorked;
use App\ProTicket\Services\Specializations\UploadFilesTemp;
use App\ProTicket\Services\TicketService;
use App\ProTicket\Services\TimeLineTicketService;
use App\ProTicket\Services\TypeTicketService;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    private $service;
    private $projectService;
    private $priorityService;
    private $typeTicketService;
    private $impactService;
    private $timeLineService;
    /**
     * Create a new controller instance.
     *
     * @param TicketService $ticketService
     * @param ProjectService $projectService
     * @param PriorityService $priorityService
     * @param TypeTicketService $typeTicketService
     * @param ImpactService $impactService
     */
    public function __construct(
        TicketService $ticketService,
        ProjectService $projectService,
        PriorityService $priorityService,
        TypeTicketService $typeTicketService,
        ImpactService $impactService,
        TimeLineTicketService $timeLineTicketService
    ) {
        $this->middleware('auth');
        $this->service = $ticketService;
        $this->projectService = $projectService;
        $this->priorityService = $priorityService;
        $this->typeTicketService = $typeTicketService;
        $this->impactService = $impactService;
        $this->timeLineService = $timeLineTicketService;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $pageTitle = 'Chamados';
        $tickets = $this->service->renderList();
        $projects = $this->projectService->renderList();
        $priorities = $this->priorityService->renderList();
        $types = $this->typeTicketService->renderList();
        $impacts = $this->impactService->renderList();
        return view(
            'dashboard.ticket.index',
            compact(
                'pageTitle',
                'tickets',
                'projects',
                'priorities',
                'types',
                'impacts'
            )
        );
    }

    public function create()
    {
        $pageTitle = 'Chamados Novo';

        $projects = $this->projectService->renderProjectsByUser();
        $priorities = $this->priorityService->renderList();
        $types = $this->typeTicketService->renderList();
        $impacts = $this->impactService->renderList();
        return view(
            'dashboard.ticket.create',
            compact(
                'pageTitle',
                'projects',
                'priorities',
                'types',
                'impacts'
            )
        );
    }

    /**
     * @param TicketStore $request
     * @return RedirectResponse
     */
    public function store(TicketStore $request)
    {
        try {
            DB::beginTransaction();

            $this->service->buildInsert($request->all());
            DB::commit();
            SessionFlashMessage::success(SessionFlashMessage::STORE);
            return redirect()->route('chamados');
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
            return redirect()->route('chamados');
        }

        $pageTitle = 'Impactos Editar';
        $impact = $this->service->renderEdit($id);
        return view('dashboard.ticket.edit', compact('pageTitle', 'impact'));
    }

    public function update($id, StatusTicketStore $request)
    {
        try {
            DB::beginTransaction();

            if (!RegisterNotFound::validate($this->service, $id)) {
                return redirect()->route('chamados');
            }

            $this->service->buildUpdate($id, $request->all());
            DB::commit();
            SessionFlashMessage::success(SessionFlashMessage::UPDATE);
            return redirect()->route('chamados');
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
                return redirect()->route('chamados');
            }
            $this->service->buildDelete($id);
            SessionFlashMessage::success(SessionFlashMessage::DESTROY);
            return redirect()->route('chamados');
        } catch (Exception $e) {
            LogError::Log($e);
            SessionFlashMessage::error(SessionFlashMessage::DESTROY);
            return redirect()->route('chamados');
        }
    }

    public function detail($ticketNumber)
    {
        $ticket = $this->service->renderTicketByTicketNumber($ticketNumber);
        if (is_null($ticket)) {
            return redirect()->route('chamados');
        }
        $pageTitle = 'Chamado #' . $ticketNumber;

        $calculateTimeDiff = new CalculateHoursWorked($ticket->id);
        $trackTime = $calculateTimeDiff->calculate();

        return view('dashboard.ticket.detail', compact('pageTitle', 'ticket', 'trackTime'));
    }
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function upload(Request $request)
    {
        $path = 'tmp/evidences/' . auth()->user()->id;

        $upload = new UploadFilesTemp($path, $request->file('file'));
        $return = $upload->execute();
        return response()->json(['name' => $return]);
    }

    public function storeOccurence(Request $request)
    {
        try {
            DB::beginTransaction();


            DB::commit();
            SessionFlashMessage::success(SessionFlashMessage::STORE);
            return redirect()->route('chamados');
        } catch (Exception $e) {
            DB::rollBack();
            LogError::Log($e);

            SessionFlashMessage::error(SessionFlashMessage::STORE);
            return back()->withInput();
        }
    }

    public function storeActions(Request $request)
    {
        try {
            DB::beginTransaction();

            $track =  $this->timeLineService->storeTrack($request->all());
            $ticket = $this->service->renderTicketByTicketNumber($request->input('ticketNumber'));
            $calculateTimeDiff = new CalculateHoursWorked($ticket->id);
            $trackTime = $calculateTimeDiff->calculate();
            DB::commit();
            SessionFlashMessage::success(SessionFlashMessage::STORE);
            return response()->json(['data' => [
                'time_total' => $trackTime,
                'track' => $track
            ]], 201);
        } catch (Exception $e) {
            DB::rollBack();
            LogError::Log($e);
            return response()->json(['data' => 'Ocorreu um problema'], 500);
        }
    }
}
