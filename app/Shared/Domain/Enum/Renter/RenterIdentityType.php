<?php

declare(strict_types=1);

namespace App\Shared\Domain\Enum\Renter;

enum RenterIdentityType: string
{
    case NATIONAL_ID = 'national_id';
    case PASSPORT = 'passport';

    public static function labels(): array
    {
        return [
            self::NATIONAL_ID->value => 'رقم قومى',
            self::PASSPORT->value => 'باسبور',
        ];
    }
     public static function hasValue(string $value): bool
    {
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return true;
            }
        }
        return false;
    }

    public function toLabel():string|null{
        foreach (self::labels() as $value=>$label) {
            if ($value == $this->value) return $label;
        }
        return null;
    }

}
