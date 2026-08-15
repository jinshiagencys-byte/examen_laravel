<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;

class Login extends Component
{
    public $email = '';
    public $password = '';

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $credentials = $this->validate();

        if (auth()->attempt($credentials)) {
            session()->regenerate();
            return redirect('/loans');
        }
        
        $this->addError('password', trans('auth.failed'));
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.auth');
    }
}
