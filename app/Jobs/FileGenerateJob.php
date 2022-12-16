<?php

namespace App\Jobs;

use App\Models\Folder;
use App\Models\Note;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use PDF;

class FileGenerateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $data;


    public function __construct($data)
    {
        $this->data = $data;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       $folder=Folder::find($this->data->folder_id);
        $note = [
            'data' => $this->data,
        ];
        $pdf = PDF::loadView('note',$note);
        $fileName = $this->data->name.'.'.$this->data->type;
        $filePath = $folder->name;
        Storage::disk('public')->put($filePath.'/'. $fileName, $pdf->output());
    }
}
