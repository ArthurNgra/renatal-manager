<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use function config;
use function config_path;
use function storage_path;

abstract class PDFService
{
    protected string $storageDirectory;
    public function __construct($storageDirectory)
    {
        $this->storageDirectory = $storageDirectory;
    }

    public abstract function generatePDF( $data);

}
