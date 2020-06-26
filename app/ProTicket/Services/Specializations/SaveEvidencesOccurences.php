<?php


namespace App\ProTicket\Services\Specializations;

use App\ProTicket\Models\DocumentOccurence;
use Illuminate\Support\Facades\Storage;

class SaveEvidencesOccurences
{

    private $documents;
    private $ticketNumber;
    private $occurenceId;

    public function __construct(array $documents, string $ticketNumber, int $occurenceId = null)
    {
        $this->documents = $documents;
        $this->ticketNumber = $ticketNumber;
        $this->occurenceId = $occurenceId;
    }

    public function execute()
    {
        foreach ($this->documents as $key => $document) {
            if (Storage::exists($document)) {
                $fileName = explode('/', $document);
                $newPath = 'ticket/' . $this->ticketNumber . '/' . $this->occurenceId . '/' . end($fileName);
                DocumentOccurence::create([
                    'occurences_id' => $this->occurenceId,
                    'extension_document' => explode('.', end($fileName))[1],
                    'name' => $newPath
                ]);

                Storage::move($document, $newPath);
            }
        }
    }
}
