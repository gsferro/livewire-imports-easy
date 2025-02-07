<?php

namespace Gsferro\LivewireImportEasy\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class LivewireImportJobEasy implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private $uploadFile,
        private readonly string $importClass,
        private readonly array $params = []
    ) {}

    public function handle(): void
    {
        $class = ! empty($this->params)
            ? new $this->importClass(...$this->params)
            : new $this->importClass;

        Excel::import($class, $this->uploadFile);
    }
}
