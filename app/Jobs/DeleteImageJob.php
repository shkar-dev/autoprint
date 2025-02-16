<?php

namespace App\Jobs;

use App\Models\UploadedImage;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DeleteImageJob implements ShouldQueue
{
    use Queueable,Dispatchable;
    public function __construct()
    {
    }
    public function handle(): void
    {
        $oldImages = UploadedImage::where('created_at', '<=', Carbon::now()->subMinutes(1))->get();
         foreach ($oldImages as $image) {
            $imagePath = public_path($image->name);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
                Log::alert('image has been deleted'.$image->id);
                $image->delete();
            }
        }
    }
}
