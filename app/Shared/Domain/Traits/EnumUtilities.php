<?php

declare (strict_types= 1);
namespace App\Shared\Domain\Traits;

trait EnumUtilities {
     public static function hasValue(string $value): bool
    {
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return true;
            }
        }
        return false;
    }

    /**
     * convert selected value to string label  
     * @return string|null
     */
    public function toLabel():string|null{
        foreach (self::labels() as $value=>$label) {
            if ($value == $this->value) return $label;
        }
        return null;
    }

    /**
     * generate associative array that contains string label 
     * for each case of this enum   
     * @return array<string>
     */
    abstract public static function labels(): array;

}