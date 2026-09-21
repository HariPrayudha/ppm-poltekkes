<?php

namespace App\Enums;

enum UserRole: string
{
    case SuperAdmin = 'super_admin';
    case OperatorMutu = 'operator_mutu';

    public function label(): string
    {
        return match ($this) {
            self::SuperAdmin => 'Super Admin',
            self::OperatorMutu => 'Operator Mutu',
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::SuperAdmin => 'bg-emerald-100 text-emerald-800',
            self::OperatorMutu => 'bg-sky-100 text-sky-800',
        };
    }
}
