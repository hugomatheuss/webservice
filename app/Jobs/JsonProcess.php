<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Product;

class JsonProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $jsonFile = array();

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file)
    {   
        $this->jsonFile = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach (array_chunk($this->jsonFile, 7) as $f) {
            foreach ($f as $d) {
                Product::create($d);
            }
        }
    }
}