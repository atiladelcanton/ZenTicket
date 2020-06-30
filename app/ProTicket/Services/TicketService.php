<?php


namespace App\ProTicket\Services;


use App\ProTicket\Contracts\ServiceContract;
use App\ProTicket\Models\Project;
use App\ProTicket\Repositories\DocumentRepository;
use App\ProTicket\Repositories\TicketRepository;

use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class TicketService implements ServiceContract
{
    private $ticketRepository;
    private $documentRepository;
    public function __construct(TicketRepository $ticketRepository, DocumentRepository $documentRepository)
    {
        $this->ticketRepository = $ticketRepository;
        $this->documentRepository = $documentRepository;
    }


    /**
     * @inheritDoc
     */
    public function renderList(string $column = 'id', $orderColum = 'DESC')
    {
        return $this->ticketRepository->getAll($column, $orderColum);
    }

    /**
     * @inheritDoc
     */
    public function renderEdit(int $id)
    {
        return $this->ticketRepository->getById($id);
    }

    /**
     * @inheritDoc
     */
    public function buildUpdate(int $id, array $data)
    {
        return $this->ticketRepository->update($id, $data);
    }

    /**
     * @inheritDoc
     */
    public function buildInsert(array $data)
    {
        $data = $this->sanitilizeData($data);

        $ticket = $this->ticketRepository->create($data);
        foreach ($data['document'] as $key => $document) {

            if (Storage::exists($document)) {
                $fileName = explode('/', $document);
                $newPath = 'ticket/' . $ticket->ticket_number . '/' . end($fileName);
                $this->documentRepository->create(
                    [
                        'occurences_id' => $ticket->id,
                        'extension_document' => explode('.', end($fileName))[1],
                        'name' => $newPath
                    ]
                );

                Storage::move($document, $newPath);
            }
        }
        $path = 'tmp/evidences/' . auth()->user()->id;
        Storage::deleteDirectory($path);

        return $ticket;
    }

    private function sanitilizeData($data)
    {
        $data['ticket_number'] = $this->generateTicketNumber();

        if (isset($data['project_id'])) {
            $data['ticket_number'] = $this->generateTicketNumber();
        } else {
            $data['project_id'] = auth()->user()->projectsUser[0]['project_id'];
        }
        $data['user_open_ticket'] = auth()->user()->id;

        return $data;
    }

    private function generateTicketNumber($project_id = null)
    {
        $project = Project::find(auth()->user()->projectsUser[0]->project_id);

        if (is_null($project_id)) {
            $projectName = explode(' ', $project->name);
        } else {
            $projectName = explode(' ', $project->name);
        }

        $name = '';
        foreach ($projectName as $key => $value) {
            $name .= substr($value, 0, 1);
        }
        $uuid = Uuid::uuid1();
        $name .= explode('-', $uuid->toString())[0];
        return $name;
    }
    public function renderTicketByTicketNumber($ticketNumber)
    {
        return $this->ticketRepository->getTicketByTicketNumber($ticketNumber);
    }
    /**
     * @inheritDoc
     */
    public function buildDelete(int $id)
    {
        return $this->ticketRepository->delete($id);
    }
}
