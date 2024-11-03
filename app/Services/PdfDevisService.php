<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Storage;
use function storage_path;
use function with;

class PdfDevisService extends PDFService
{
    public function __construct()
    {
        parent::__construct(storage_path('app/public/pdf/devis/'));
    }

    public function generatePDF($data)
    {
        // Définir le chemin du dossier
        $directoryPath = storage_path('app/public/pdf/devis/' . $data['client']->lastname . '/');

        // Vérifier si le dossier existe, sinon le créer
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }

        $pdf = $this->generatePDFFromTemplate($data);

        $fileName = 'devis_' . $data['location']->address . '_' . Carbon::make($data['location']->from)->format('d M Y') . '-' . Carbon::make($data['location']->to)->format('d M Y') . '.pdf';
      return  Storage::disk('local')->put('pdf/devis/' . $data['client']->lastname . '/' . $fileName, $pdf->output());

    }

    public static function generatePDFFromTemplate($data)
    {
        return $pdf = PDF::loadView('devis.DevisConfirmationPDF', with(
            [
                'devis' => $data['devis'],
                'client' => $data['client'],
                'materials' => $data['materials'],
                'location' => $data['location'],
                'user' => $data['user'],
                'company' => $data['company']
            ]
        ));
    }
}
