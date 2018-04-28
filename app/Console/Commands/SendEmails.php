<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail; 
use App\User;
class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:last-login';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send an email notification to clients ​ who didn’t login from the
    past month​';

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
     * @return mixed
     */
    public function handle()
    {
        $users=User::All();
  
        $missed_users=[];
        foreach($users as $user){

            $lastLogin = \Carbon\Carbon::parse($user->last_login);

            $current = \Carbon\Carbon::parse(date('Y-m-d H:i:s'));

            $diffInMonth = $current->diffInMonths($lastLogin);

            if($diffInMonth>=1){
                $missed_users[]=$user;
            }
        }

      
     
            Mail::send('mail', ['user' => $missed_users], function ($m) use ($missed_users) {
                foreach ($missed_users as $user){

                    $m->from('hebamamdouh2016@gmail.com', 'heba mamdouh');
        
                    $m->to($user->email, $user->name)->subject('Reminder');
                }
               
            });

    }
}
