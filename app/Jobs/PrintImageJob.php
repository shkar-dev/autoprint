<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PrintImageJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $path;

    public function __construct($path )
    {
        $this->path = $path;
    }

    public function handle()
    {
         // Print the image (for Windows use "print" command, for Linux/macOS use "lp")
//        $printerCommand = "print " . escapeshellarg($imagePath); // Linux/macOS
//        $imagePath = storage_path('app/public/' . $this->path);
        $imagePath = public_path($this->path);
        Log::alert($imagePath);
//        $printerCommand = 'mspaint /p ' . escapeshellarg($imagePath) ; this workes well with mspaint
        $printerCommand = 'ms-photos: /print ' . escapeshellarg($imagePath) ;
        //        $printerCommand = 'C:\windows\system32\mspaint.exe /p ' . escapeshellarg($imagePath) . ' Canon LBP6000/LBP6018';
//        "C:\windows\system32\mspaint.exe" /p "C:\Users\Jason\Documents\UnityProjects\Test-Printing\Assets\test.png" "INSERT_NAME_OF_YOUR_PRINTER_HERE"
        exec($printerCommand);
    }
}
//        $printerCommand = "notepad /p " . escapeshellarg($imagePath);
