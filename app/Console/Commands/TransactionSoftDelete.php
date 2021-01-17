<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaction;

class TransactionSoftDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:softdelete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Completely Delete transaction older than one month';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $soft = Transaction::onlyTrashed()->where('deleted_at', '<', now()->subMonth(1));

        $count = $soft->count();

        $soft->forceDelete();

        $this->info("{$count} Record(s) deleted");

        return $count;
    }
}
