<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent;

use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\Entities\Renter\RenterEntity;
use App\Shared\Domain\Entities\SharedWaterInvoice\SharedWaterInvoiceEntity;
use App\Shared\Domain\Entities\Transaction\TransactionEntity;
use App\Shared\Domain\Entities\Unit\UnitContractEntity;
use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Domain\Enum\Renter\RenterIdentityType;
use App\Shared\Domain\Enum\Unit\UnitContractType;
use App\Shared\Domain\Enum\Unit\UnitType;
use App\Shared\Domain\Repositories\SharedWaterInvoiceRepository;
use App\Shared\Infrastructure\Models\SharedWaterInvoice\SharedWaterInvoice;
use App\Shared\Infrastructure\Utilities\CarbonDateUtility;

final class EloquentSharedWaterInvoiceRepository implements SharedWaterInvoiceRepository
{
    /**
     * @return array<SharedWaterInvoiceEntity>
     */
    public function index(): array
    {
        return [];
    }
    /**
     * @return array<SharedWaterInvoiceEntity>
     */
    public function indexByYear(int $contractId, int $year): array
    {
        $sharedWaterInvoicesRecords = SharedWaterInvoice::with('transaction')->where('contract_id', $contractId)
            ->where('for_year', $year)->get();

        $sharedWaterInvoiceEntities = [];
        foreach ($sharedWaterInvoicesRecords as $record) {
            $transactionEntity = new TransactionEntity(
                id: $record->transaction->id,
                date: CarbonDateUtility::from($record->transaction->date),
                amount: $record->transaction->amount,
                description: $record->transaction->description,
            );
            $transactionEntity->setDirection(); // set whether it's withdraw or deposit
            $sharedWaterInvoiceEntities[] = new SharedWaterInvoiceEntity(
                id: $record->id,
                contractId: $record->contract_id,
                transactionId: $record->transaction_id,
                sharedValue: $record->shared_value,
                forMonth: $record->for_month,
                forYear: $record->for_year,
                transaction: $transactionEntity,
            );
        }
        return $sharedWaterInvoiceEntities;
    }
    public function show(int $sharedWaterInvoiceId): SharedWaterInvoiceEntity|null
    {
        $record = SharedWaterInvoice::with('transaction', 'contract', 'contract.renter', 'contract.unit', 'contract.unit.estate')->find($sharedWaterInvoiceId);
        if ($record) {
            $transactionEntity = new TransactionEntity(
                id: $record->transaction->id,
                date: CarbonDateUtility::from($record->transaction->date),
                amount: $record->transaction->amount,
                description: $record->transaction->description,
            );
            $transactionEntity->setDirection();

            $renterEntity = new RenterEntity(
                id: $record->contract->renter->id,
                name: $record->contract->renter->name,
                identityType: RenterIdentityType::from($record->contract->renter->identity_type),
                identityNumber: $record->contract->renter->identity_number,
                notes: $record->contract->renter->notes,
            );

            $estateEntity = new EstateEntity(
                id: $record->contract->unit->estate->id,
                name: $record->contract->unit->estate->name,
                address: $record->contract->unit->estate->address,
                floorCount: $record->contract->unit->estate->floor_count,
            );

            $unitEntity = new UnitEntity(
                id: $record->contract->unit->id,
                estateId: $record->contract->unit->estate_id,
                number: $record->contract->unit->number,
                floorNumber: $record->contract->unit->floor_number,
                type: UnitType::from($record->contract->unit->type),
                isEmpty: $record->contract->unit->is_empty ? true : false,
                estate: $estateEntity,
            );

            $unitContractEntity  = new UnitContractEntity(
                id: $record->contract->id,
                unitId: $record->contract->unit_id,
                renterId: $record->contract->renter_id,
                type: UnitContractType::from($record->contract->type),
                rentValue: $record->contract->rent_value, // the contract rent value
                annualRentIncreasement: $record->contract->annual_rent_increasement,
                insuranceValue: $record->contract->insurance_value,
                startDate: CarbonDateUtility::from($record->contract->start_date),
                endDate: CarbonDateUtility::from($record->contract->end_date),
                waterInvoicePercentage: $record->contract->water_invoice_percentage,
                electricityInvoicePercentage: $record->contract->electricity_invoice_percentage,
                renter: $renterEntity,
                unit: $unitEntity,
            );

            return new SharedWaterInvoiceEntity(
                id: $record->id,
                contractId: $record->contract_id,
                transactionId: $record->transaction_id,
                sharedValue: $record->shared_value,
                forMonth: $record->for_month,
                forYear: $record->for_year,
                transaction: $transactionEntity,
                unitContract: $unitContractEntity,
            );
        }
        return  null;
    }

    public function showByUtilityServiceInvoiceId (int $utilityServiceInvoiceId):array{
        $sharedWaterInvoicesRecords = SharedWaterInvoice::with('transaction')
            ->where('utility_service_invoice_id', $utilityServiceInvoiceId)
            ->get();
        $sharedWaterInvoiceEntities = [];
        foreach ($sharedWaterInvoicesRecords as $record) {
            $transactionEntity = new TransactionEntity(
                id: $record->transaction->id,
                date: CarbonDateUtility::from($record->transaction->date),
                amount: $record->transaction->amount,
                description: $record->transaction->description,
            );
            $transactionEntity->setDirection(); // set whether it's withdraw or deposit
            $sharedWaterInvoiceEntities[] = new SharedWaterInvoiceEntity(
                id: $record->id,
                contractId: $record->contract_id,
                utilityServiceInvioceId: $record->utility_service_invoice_id,
                transactionId: $record->transaction_id,
                sharedValue: $record->shared_value,
                forMonth: $record->for_month,
                forYear: $record->for_year,
                transaction: $transactionEntity,
            );
        }
        return $sharedWaterInvoiceEntities;
    }
    public function store(SharedWaterInvoiceEntity $sharedWaterInvoiceEntity): SharedWaterInvoiceEntity
    {
        SharedWaterInvoice::create([
            'contract_id' => $sharedWaterInvoiceEntity->contractId,
            'transaction_id' => $sharedWaterInvoiceEntity->transactionId,
            'utility_service_invoice_id' => $sharedWaterInvoiceEntity->utilityServiceInvioceId,
            'shared_value' => $sharedWaterInvoiceEntity->sharedValue,
            'for_month' => $sharedWaterInvoiceEntity->forMonth,
            'for_year' => $sharedWaterInvoiceEntity->forYear,
        ]);
        return new SharedWaterInvoiceEntity();
    }
    public function update(SharedWaterInvoiceEntity $sharedWaterInvoiceEntity): bool
    {
        return SharedWaterInvoice::find($sharedWaterInvoiceEntity->id)->update([
            'shared_value' => $sharedWaterInvoiceEntity->sharedValue,
            'for_month' => $sharedWaterInvoiceEntity->forMonth,
            'for_year' => $sharedWaterInvoiceEntity->forYear,
        ]);
    }
    public function destroy(int $sharedWaterInvoiceId): bool
    {
        return false;
    }
}
