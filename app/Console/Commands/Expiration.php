<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class Expiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:expire'; //اسم دال على الحاجه ال عايز اعملها

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'expire user every five minuites automatically'; //دا وصف عشان لو حد شغال معايا يفهم انا بعمل ايه

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
        $users = User::where('expire', 0)->get(); //return collection of users in database

        foreach ($users as $user) {
            $user->update(['expire' => 1]);
        }
    }
}
