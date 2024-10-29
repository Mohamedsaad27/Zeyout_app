<?php

namespace App\Console\Commands;

use App\Models\Trader;
use Illuminate\Console\Command;

class DeactivateTraders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deactivate-traders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update expired traders to inactive status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Trader::where('is_active', true)
            ->where('expires_at', '<=', now())
            ->update(['is_active' => false]);

        $this->info('Expired traders have been updated successfully.');
    }
}
