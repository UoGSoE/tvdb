<?php

namespace App\Jobs;

use App\Models\Tv;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class UpdateMachine implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $computer_name;
    public $computer_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $computer_name, string $computer_id)
    {
        $this->computer_name = $computer_name;
        $this->computer_id = $computer_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $computer = Tv::where('computer_name', '=', $this->computer_name)->firstOrNew();

        $computer->computer_name = $this->computer_name;
        $computer->computer_id = $this->computer_id;
        $computer->last_seen = now();
        $computer->save();
    }
}
