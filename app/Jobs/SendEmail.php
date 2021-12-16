<?php

namespace App\Jobs;

use App\Mail\PublishedPost;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $admin;
    private $post;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct($admin, $post)
    {
        $this->admin = $admin;
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new PublishedPost($this->post);
        Mail::to($this->admin)->send($email);
    }
}
