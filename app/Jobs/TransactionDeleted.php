<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\TransactionDeleted as TransactionDeletedTemplate;
use Mail;

class TransactionDeleted implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tran;
    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $tran)
    {
        $this->tran = $tran;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user)->send(new TransactionDeletedTemplate($this->tran));
    }
}
