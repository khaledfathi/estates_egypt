<?php

namespace App\Features\Units\Infrastructure\ValidationRules;

use App\Shared\Domain\Enum\Unit\UnitType;
use App\Shared\Infrastructure\Models\Unit\Unit;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final readonly class LastUnitNumber implements ValidationRule
{
    public function __construct(
        private int $estateId,
        private UnitType $unitType,
    ) {}
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $lastUnitNumber = Unit::where('estate_id', $this->estateId,)
            ->where('type', $this->unitType->value)
            ->max('number');
        if ($value > $lastUnitNumber + 1) {
            $lastUnitNumber
                ? $fail('ارقام الوحدات يجب ان تكون متتالية | اخر رقم مسجل لل' . $this->unitType->toLabel() . ' هو ' . $lastUnitNumber)
                : $fail('ارقام الوحدات يجب ان تكون متتالية وتبدأ من رقم 1 | لم يتم ادخال اى وحدات لل'.$this->unitType->toLabel() . ' حتى الآن') ;
        }
    }
}
