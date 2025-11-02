<?php

namespace App\Features\UnitContracts\Presentation\Http\Requests\Rules; 

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

/**
 * Check if the start date input 
 */
class UnitContractDateIntersectionRule implements ValidationRule
{
    public function __construct(
        private readonly string $endDate,
        private readonly string $unitId,
        private readonly ?string $ignore = null,
    ) {}
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $startDate = $value;
        if (!$startDate) return;
        $query = DB::table('unit_contracts')  
            ->where('unit_id', $this->unitId)
            ->where('end_date', '>=', $startDate)
            ->where('start_date', '<=', $this->endDate);
        if ($this->ignore) $query->where('id' , '!=',$this->ignore);

        if ($query->exists()) {
            $fail("الفترة بين $startDate و $this->endDate متقاطعة مع تعاقد اخر موجود بالفعل لهذة الوحدة");
        }
    }
}
