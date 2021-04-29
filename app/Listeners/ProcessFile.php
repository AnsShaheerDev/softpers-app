<?php

namespace App\Listeners;

use App\Events\FileUploaded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Maatwebsite\Excel\HeadingRowImport;

use App\Imports\DataImport;

use Excel;
use Storage;
class ProcessFile implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FileUploaded  $event
     * @return void
     */
    public function handle(FileUploaded $event)
    {
       $import = new DataImport($event->file);
       Excel::import($import,$event->file->path,'public');
       
       $event->file->update(['status'=>'ready']);

    }
}
