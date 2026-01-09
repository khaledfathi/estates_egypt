<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entities\Unit;

use App\Shared\Domain\Contracts\DateProviderContract;
use App\Shared\Domain\Entities\Renter\RenterEntity;
use App\Shared\Domain\Enum\Unit\UnitContractType;
use Exception;

final class UnitContractEntity
{
    public function __construct(
        public ?int $id = null,
        public ?int $unitId = null,
        public ?int $renterId = null,
        public ?UnitContractType $type = null,
        public ?int $rentValue = null, // the contract rent value
        public ?int $annualRentIncreasement = null,
        public ?int $insuranceValue = null,
        public ?DateProviderContract $startDate = null,
        public ?DateProviderContract $endDate = null,
        public ?float $waterInvoicePercentage = null,
        public ?float $electricityInvoicePercentage = null,
        public ?RenterEntity $renter = null,
        public ?UnitEntity $unit = null,
    ) {}

    public function getCurrentRentValue(?DateProviderContract $untilDate=null): int
    {
        if ($this->rentValue >= 0  && $this->startDate != null && $this->annualRentIncreasement >= 0) {
            $years = $untilDate 
                ? $this->startDate->yearsUntil($untilDate)
                : $this->startDate->yearsUntilNow();
            $currentValue = $this->rentValue;
            for ($i = 1; $i < $years; $i++) {
                $currentValue += $currentValue * $this->annualRentIncreasement / 100;
            }
            return (int)$currentValue;
        } else {
            throw new Exception("Cannot calculate CurrentRentValue without one of these [rentValue, StartDate, annualRentIncreasement] at " . __CLASS__ . "::" . __FUNCTION__);
        }
    }
    /**
     * true if this contract {@link `$this->endDate`} is passed the current date 
     * @return void
     */
    public function isExpired(): bool
    {
        return !$this->endDate->isPast();
    }
    /**
     * true if this {@link `$this->startDate`} and {@link `$this->endDate`} are in the future 
     * @return bool
     */
    public function isInFuture(): bool
    {
        return  $this->startDate->isPast() && $this->endDate->isPast();
    }
    /**
     * remaning years from {@link `$this->startDate`} to {@link `$this->endDate`} as Percentage 
     * equation = (from startDate to current year * 100 ) / whole contract period 
     * @return int
     */
    public function getYearsPassedPercentage(): int
    {

        $period = $this->startDate->yearsUntil($this->endDate); // whole contract period 
        $period = $period == 0 ? 1 : $period; // prevent division by zero 
        $unitlNow = $this->startDate->yearsUntilNow(); // years passed from start date till now  
        return (int) (($unitlNow * 100) / $period); // remaining years as persentage to whole period
    }
    public function getMonthsPassedPercentage(): int
    {

        $period = $this->startDate->monthsUnitl($this->endDate); // whole contract period 
        $period = $period == 0 ? 1 : $period; // prevent division by zero 
        $unitlNow = $this->startDate->monthsUnitlNow(); // years passed from start date till now  
        return (int) (($unitlNow * 100) / $period); // remaining years as persentage to whole period
    }
}
