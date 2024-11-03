<?php

namespace App\Services;

use function storage_path;

class PdfInvoiceService extends PDFService
{
    public function __construct()
    {
        parent::__construct(storage_path('app/private/pdf/devis/'));
    }

    public function generatePDF( $data)
    {
        // TODO: Implement generatePDF() method.
    }
}
