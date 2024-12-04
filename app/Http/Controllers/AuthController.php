<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\Auth\RegistrationDTO;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use App\Services\EmailVerificationService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{

    public function __construct(
        private AuthService $authService
    ) {}

    public function loginPage(): View
    {
        return view('auth.login');
    }

    public function registerPage(): View
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request, EmailVerificationService $emailVerificationService): RedirectResponse
    {
        $credentials = RegistrationDTO::fromRequest($request);

        $user = $this->authService->register($credentials);

        $emailVerificationService->sendVerificationCode($user);

        return redirect()->route('confirm_email');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        if ($this->authService->login($request->validated())) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => __('auth.failed')
        ]);
    }

    public function logout(LogoutRequest $request): RedirectResponse
    {
        $this->authService->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
