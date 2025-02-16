<?php

namespace App\Console\Commands;

use App\Jobs\DeleteImageJob;
use Illuminate\Console\Command;

class DeleteImageTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:delete-image-task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dispatch(new DeleteImageJob());
//        logger()->info("Task delete image task");
    }
}
