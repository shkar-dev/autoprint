<?php

namespace App\Jobs;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class PrintCardJob implements ShouldQueue
{
    use Queueable;

    protected $card1;
    protected $card2;

    public function __construct($card1, $card2)
    {
        $this->card1 = $card1;
        $this->card2 = $card2;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pdf = Pdf::loadView('images', [
            'image1' =>public_path($this->card1),
            'image2' => public_path($this->card2),
        ]);
        $pdfPath = storage_path('app/public/generated_pdf.pdf');
        file_put_contents($pdfPath, $pdf->output());
        $printerCommand = '"C:\Users\CLICK\AppData\Local\SumatraPDF\SumatraPDF.exe" -print-to-default -silent ' . escapeshellarg($pdfPath);
        shell_exec($printerCommand);
    }
}
