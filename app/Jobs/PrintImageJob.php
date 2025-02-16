<?php

namespace App\Jobs;

 use Barryvdh\DomPDF\Facade\Pdf;
 use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
 use Illuminate\Support\Facades\Storage;

 class PrintImageJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $path;
    protected $image1;
    protected $image2;
    public function __construct($path  )
    {
        $this->path = $path;

    }
    public function handle()
    {
//        $imagePath = public_path($this->path);
//        Log::alert($imagePath);
//        $printerCommand = 'mspaint /p ' . escapeshellarg($imagePath) ; //this workes well with mspaint
////        $printerCommand = 'explorer /print' . escapeshellarg($imagePath) ;
//        shell_exec($printerCommand);
//        ------------------------------------
        $pdf = Pdf::loadView('images', [
            'image1' =>public_path($this->image1),
            'image2' => public_path($this->image2),
        ]);
        // Save PDF to storage
        $pdfPath = storage_path('app/public/generated_pdf.pdf');
        file_put_contents($pdfPath, $pdf->output());
        // Print PDF (Windows example, adjust for Linux/Mac)
//        $printerCommand = 'print /d:"Microsoft Print to PDF" ' . escapeshellarg($pdfPath);
//        shell_exec($printerCommand);
//        $printerCommand = '"C:\Program Files (x86)\Microsoft\Edge\Application\msedge.exe" /print ' . escapeshellarg($pdfPath);
//        shell_exec($printerCommand);
        $printerCommand = '"C:\Users\CLICK\AppData\Local\SumatraPDF\SumatraPDF.exe" -print-to-default -silent ' . escapeshellarg($pdfPath);
        shell_exec($printerCommand);
      }
}
//        $printerCommand = "notepad /p " . escapeshellarg($imagePath);
