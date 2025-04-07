<?php

namespace App\Jobs\MM;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessMaterialData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        Log::info('Processing SAP Material Data:', $this->data);


        // Check if the material is marked as deleted
        if (!empty($this->data['deleted']) && $this->data['deleted'] === true) {
            Log::warning("Material {$this->data['material_id']} is marked as deleted.");
        }


        //Store or update the material in the database
        // \DB::table('materials')->updateOrInsert(
        //     ['material_id' => $this->data['material_id']],
        //     [
        //         'type'          => $this->data['type'],
        //         'werk'          => $this->data['werk'],
        //         'sales_channel' => $this->data['sales_channel'],
        //         'material_type' => $this->data['material_type'],
        //         'deleted'       => $this->data['deleted'] ?? false,
        //         'updated_at'    => now()
        //     ]
        // );

        Log::info("Material {$this->data['material_id']} processed successfully.");
    }
}
