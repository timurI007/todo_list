<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmEmailRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EmailVerificationController extends Controller
{
    public function confirmEmailPage(): View
    {
        return view('auth.confirm_email');
    }

    // public function confirmEmail(ConfirmEmailRequest $request): RedirectResponse
    // {

    // }
}
