<?php

namespace App\Enums;

use App\Enums\Utilities\HasOperations;
use App\Enums\Utilities\Stringable;
use Exception;

enum UserTypeEnum: int
{
    use HasOperations, Stringable;

    case Employee = 1;
    case Employer = 2;
    case Admin = 3;


    public function loginRouteName(): string
    {
        return match ($this) {
            self::Employee => 'login',
            self::Employer => 'employer.login',
            self::Admin => throw new Exception('To be implemented'),
        };
    }

    public function logoutRouteName(): string
    {
        return match ($this) {
            self::Employee => 'logout',
            self::Employer => 'employer.logout',
            self::Admin => throw new Exception('To be implemented'),
        };
    }

    public function profileRouteName()
    {
        return match ($this) {
            self::Employee => 'profile',
            self::Employer => 'employer.profile.edit',
            self::Admin => throw new Exception('To be implemented'),
        };
    }

}
