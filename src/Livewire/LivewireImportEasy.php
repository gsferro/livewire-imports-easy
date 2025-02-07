<?php

namespace Gsferro\LivewireImportEasy\Livewire;

use Gsferro\LivewireImportEasy\Jobs\LivewireImportJobEasy;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class LivewireImportEasy extends Component
{
    use WithFileUploads;

    /*
    |---------------------------------------------------
    | Controle de importação
    |---------------------------------------------------
    */
    public string $batchId;

    public $importFile;

    public bool $importing = false;

    public $importFilePath;

    public ?bool $importFinished = false;

    public string $importClass;

    /*
    |---------------------------------------------------
    | Validações
    |---------------------------------------------------
    */
    public ?string $accept = null;

    protected array $rulesImport = [
        'importFile' => 'required',
    ];

    /*
    |---------------------------------------------------
    | Parametros extras para ser enviado ao importador
    |---------------------------------------------------
    */
    protected ?array $paramsImport = null;

    /*
    |---------------------------------------------------
    | Components
    |---------------------------------------------------
    */
    public bool $importingMessageShow = true;
    public string $importingMessage = 'Importando... por favor aguarde.';
    public bool $importFinishedMessageShow = true;
    public string $importFinishedMessage = 'Importação realizada com sucesso!';


    public function mount(string $importClass, ?string $accept = null): void
    {
        // TODO melhorar validação
        if (! class_exists($importClass)) {
            abort(404, 'Import class not found');
        }

        $this->importClass = $importClass;
        $this->accept      = $accept;
    }

    public function updatedImportFile(): void
    {
        $this->reset('importing', 'importFinished');
    }

    /**
     * @throws Throwable
     */
    public function import(): void
    {
        $this->validate($this->rulesImport);

        $this->importing      = true;
        $this->importFinished = false;
        $this->importFilePath = $this->importFile->store('imports');

        $import = !is_null($this->paramsImport)
            ? new LivewireImportJobEasy($this->importFilePath, $this->importClass, $this->paramsImport)
            : new LivewireImportJobEasy($this->importFilePath, $this->importClass);

        $batch = Bus::batch([
            $import,
            // TODO runner finish
        ])->dispatch();
        $this->dispatch('start_import');

        $this->batchId = $batch->id;
    }

    public function getImportBatchProperty(): bool|Batch
    {
        if (! $this->batchId) {
            return false;
        }

        return Bus::findBatch($this->batchId) ?? false;
    }

    public function updateImportProgress(): void
    {
        $this->importFinished = $this->importBatch?->finished() ?? false;

        if ($this->importFinished) {
            Storage::delete($this->importFilePath);
            $this->importing = false;

            $this->reset('importFilePath');
            $this->dispatch('finish_import');
        }
    }
}
