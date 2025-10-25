<?php

declare(strict_types=1);

namespace App\Shared\Application\Utility;

use Exception;

class Month
{
    private static $months = [
        1 => '1 ( يناير )',
        2 => '2 ( فبراير )',
        3 => '3 ( مارس )',
        4 => '4 ( ابريل )',
        5 => '5 ( مايو )',
        6 => '6 ( يونيو )',
        7 => '7 ( يوليو )',
        8 => '8 ( اغسطس )',
        9 => '9 ( سبتمبر )',
        10 => '10 ( اكتوبر )',
        11 => '11 ( نوفمبر )',
        12 => '12 ( ديسمبر )',
    ];
    private static $monthsNameOnly = [
        1 => 'يناير',
        2 => 'فبراير',
        3 => 'مارس',
        4 => 'ابريل',
        5 => 'مايو',
        6 => 'يونيو',
        7 => 'يوليو',
        8 => 'اغسطس',
        9 => 'سبتمبر',
        10 => 'اكتوبر',
        11 => 'نوفمبر',
        12 => 'ديسمبر',
    ];
    public function __construct(
        public readonly string $name,
        public readonly int $value,
    ) {}
    public static function list(): array
    {
        $months = [];
        foreach (self::$months as $number => $name) {
            $months[] = new self(
                $name,
                $number
            );
        }
        return $months;
    }
    public static function from(int $monthNumber,bool $nameOnly = false)
    {
        $monthsArray = $nameOnly ? self::$monthsNameOnly : self::$months;
        if ($monthNumber < 1 || $monthNumber > 12)
            throw new Exception('Month::name($monthNumber) , $monthNumber should be between 1 and 12 ');
        return new self($monthsArray[$monthNumber], $monthNumber);
    }
}
