<?php

namespace App\Jobs;

use App\Mail\NotificationEmail;
use App\Mail\PemberitahuanEmail;
use App\Models\User;
use App\Notifications\ProcessNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNotificationEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle(): void
    {
        Mail::to('admin@gmail.com')->send(new NotificationEmail($this->data));
    }
}
