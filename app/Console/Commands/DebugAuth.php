<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class DebugAuth extends Command
{
    protected $signature = 'debug:auth';
    protected $description = 'Debug authentication issues';

    public function handle()
    {
        $users = User::all();
        
        $this->info("Total users: " . $users->count());
        $this->line('');
        
        foreach ($users as $user) {
            $hasPassword = !is_null($user->password) && $user->password != '';
            $this->line("Email: {$user->email}");
            $this->line("  - password_set: " . ($user->password_set ? 'YES' : 'NO'));
            $this->line("  - has_password: " . ($hasPassword ? 'YES' : 'NO'));
            $this->line("  - statut: {$user->statut}");
            $this->line('');
        }
        
        return 0;
    }
}
