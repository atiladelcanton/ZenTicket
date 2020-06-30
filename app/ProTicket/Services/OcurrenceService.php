<?php


namespace App\ProTicket\Services;


use App\ProTicket\Contracts\ServiceContract;
use App\ProTicket\Repositories\DocumentOccurenceRepository;
use App\ProTicket\Repositories\OcurrenceRepository;
use Illuminate\Support\Facades\Storage;

class OcurrenceService implements ServiceContract
{
    private $ocurrenceRepository;
    private $documentOccurenceRepository;
    public function __construct(OcurrenceRepository $ocurrenceRepository, DocumentOccurenceRepository $documentOccurenceRepository)
    {
        $this->ocurrenceRepository = $ocurrenceRepository;
        $this->documentOccurenceRepository = $documentOccurenceRepository;
    }


    /**
     * @inheritDoc
     */
    public function renderList(string $column = 'id', $orderColum = 'DESC')
    {
        return $this->ocurrenceRepository->getAll($column, $orderColum);
    }

    /**
     * @inheritDoc
     */
    public function renderEdit(int $id)
    {
        return $this->ocurrenceRepository->getById($id);
    }

    /**
     * @inheritDoc
     */
    public function buildUpdate(int $id, array $data)
    {
        return $this->ocurrenceRepository->update($id, $data);
    }

    /**
     * @inheritDoc
     */
    public function buildInsert(array $data)
    {

        $data['user_id'] = auth()->user()->id;

        $occurence = $this->ocurrenceRepository->create($data);
        if (isset($data['document_occurence'])) {
            foreach ($data['document_occurence'] as $key => $document) {

                if (Storage::exists($document)) {

                    $fileName = explode('/', $document);
                    $newPath = 'ticket/' . $data['ticketNumber'] . '/' . $occurence->id . '/' . end($fileName);

                    $this->documentOccurenceRepository->create(
                        [
                            'occurences_id' => $occurence->id,
                            'extension_document' => explode('.', end($fileName))[1],
                            'name' => $newPath
                        ]
                    );

                    Storage::move($document, $newPath);
                }
            }
            $path = 'tmp/evidences/' . auth()->user()->id;
            Storage::deleteDirectory($path);
        }
    }

    /**
     * @inheritDoc
     */
    public function buildDelete(int $id)
    {
        return $this->ocurrenceRepository->delete($id);
    }
}
