<?php

namespace App\Services;

use App\Exceptions\EmailVerificationException;
use App\Jobs\SendEmailJob;
use App\Models\EmailVerification;
use App\Models\User;
use Exception;
use Illuminate\Support\Carbon;

class EmailVerificationService
{
    const CODE_EXPIRATION = 3;

    public function sendVerificationCode(User $user): void
    {
        if (! $this->isAbleToSend($user->id)) {
            throw new EmailVerificationException('You can request a new verification code only after 3 minutes.');
        }

        $code = $this->generateCode();

        EmailVerification::create([
            'user_id' => $user->id,
            'verification_code' => $code,
        ]);

        SendEmailJob::dispatch($user);
    }

    public function isAbleToSend(int $user_id): bool
    {
        $lastVerification = EmailVerification::where('user_id', $user_id)
            ->latest('created_at')
            ->first();
        
        if ($lastVerification && $lastVerification->created_at > Carbon::now()->subMinutes(self::CODE_EXPIRATION)) {
            return false;
        }

        return true;
    }

    private function generateCode(): int
    {
        return random_int(100000, 999999);
    }
}
