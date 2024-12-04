<?php

namespace App\DataTransferObjects\Auth;

use App\Http\Requests\RegisterRequest;

class RegistrationDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password
    ) {}

    public static function fromRequest(RegisterRequest $request): self
    {
        $credentials = $request->safe()->only(['name', 'email', 'password']);
        
        return new self($credentials['name'], $credentials['email'], $credentials['password']);
    }
}