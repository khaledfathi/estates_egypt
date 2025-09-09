<?php
declare (strict_types= 1);

namespace App\Helper; 

final class  Helper{
    public static function getFirstWord(string $string): string{
        return explode(' ', trim($string))[0] ?? '';
    }
}