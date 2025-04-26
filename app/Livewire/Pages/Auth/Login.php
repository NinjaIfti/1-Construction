<?php

namespace App\Livewire\Pages\Auth;

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Login extends Component
{
    public LoginForm $form;

    /**
     * Handle the login form submission.
     */
    public function login(): void
    {
        $this->form->authenticate();

        Session::regenerate();

        $user = Auth::user();
        
        // Redirect based on user role
        if ($user->isAdmin()) {
            $this->redirect(route('admin.dashboard', absolute: false));
        } else {
            $this->redirect(route('client.dashboard', absolute: false));
        }
    }

    /**
     * Render the login component.
     */
    public function render()
    {
        return view('livewire.pages.auth.login');
    }
} 