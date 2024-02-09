<?php

namespace App\Console\Commands;

use App\Mail\NotifyEmail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class Notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'notify users by there emails in db about any thing';

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
        //$users = User::select('email')->get(); //arrayبيرجعلي كل الايميلات في شكل 
        /*
        
                    ==        
        */
        $emails = User::pluck('email')->toArray(); //arrayبيرجعلي كل الايميلات في شكل 
        $data = ['title' => 'programming', 'body' => 'php'];

        foreach ($emails as $email) {
            //how to send emails in laravel

            Mail::to($email)->send(new NotifyEmail($data));
        }
    }
}
