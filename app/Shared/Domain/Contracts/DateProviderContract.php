<?php
declare (strict_types=1);
namespace App\Shared\Domain\Contracts; 

interface  DateProviderContract {
    public static function from (string $date):DateProviderContract;
    public function toDateString(): string;
    public function year():int;
    public function month():int;
    public function day():int;
    public function isPast():bool;
    public static function now(): DateProviderContract;
    public function monthsUnitlNow ():int;
    public function monthsUnitl (DateProviderContract $date):int;
    public function yearsUntillNow():int;
    public function yearsUntill(DateProviderContract $date):int;
}