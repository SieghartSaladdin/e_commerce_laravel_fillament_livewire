<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Login')]
class LoginPage extends Component
{
    public $email;
    public $password;

    public function save()
    {
        $this->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|max:255'
        ]);

        if(!auth()->attempt(['email' => $this->email, 'password' => $this->password])){
            session()->flash('error', 'invalid credentials');
            return;
        }

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.auth.login-page');
    }
}
