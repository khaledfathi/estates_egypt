<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent;

use App\Models\RentInvoice;
use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\Entities\Renter\RenterEntity;
use App\Shared\Domain\Entities\RentsPayment\RentInvoiceEntity;
use App\Shared\Domain\Entities\Transaction\TransactionEntity;
use App\Shared\Domain\Entities\Unit\UnitContractEntity;
use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Domain\Enum\Renter\RenterIdentityType;
use App\Shared\Domain\Enum\Unit\UnitContractType;
use App\Shared\Domain\Enum\Unit\UnitType;
use App\Shared\Domain\Repositories\RentInvoiceRepository;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Domain\ValueObjects\Pagination;
use App\Shared\Infrastructure\Utilities\CarbonDateUtility;

final class EloquentRentInvoiceRepository implements RentInvoiceRepository
{
    /**
     * @inheritDoc
     */
    public function index(): array
    {
        return [];
    }
    /**
     * @inheritDoc
     */
    public function indexWithPaginateByYear(int $year): EntitiesWithPagination
    {
        $records = RentInvoice::with('transaction')->where('for_year', $year)->orderBy('for_month')->paginate();
        $rentInvoicesEntities = [];
        foreach ($records as $record) {
            //transaction DTO 
            $transaction = $record->transaction;
            $transactionEntity = new TransactionEntity(
                id: $transaction->id,
                date: CarbonDateUtility::from($transaction->date),
                amount: $transaction->amount,
                description: $transaction->description,
            );
            $transactionEntity->setDirection();
            //rentInvoice DTO 
            $rentInvoicesEntities[] = new RentInvoiceEntity(
                id: $record->id,
                transactionId: $record->transaction_id,
                contractId: $record->contract_id,
                forMonth: $record->for_month,
                forYear: $record->for_year,
                transaction: $transactionEntity,
            );
        }
        //Pagination DTO
        $paginationData = new Pagination(
            perPage: $records->perPage(),
            currentPage: $records->currentPage(),
            path: $records->path(),
            pageName: $records->getPageName(),
            total: $records->total(),
        );
        return new EntitiesWithPagination(
            $paginationData,
            $rentInvoicesEntities,
        );
    }
    public function store(RentInvoiceEntity $RentInvoiceEntity): RentInvoiceEntity
    {
        $record = RentInvoice::create([
            'contract_id' => $RentInvoiceEntity->contractId,
            'transaction_id' => $RentInvoiceEntity->transaction->id,
            'for_month' => $RentInvoiceEntity->forMonth,
            'for_year' => $RentInvoiceEntity->forYear,
        ]);
        $RentInvoiceEntity->id = $record->id;
        return $RentInvoiceEntity;
    }
    public function show(int $renterId): RentInvoiceEntity|null
    {
        $record = RentInvoice::with('contract', 'transaction', 'contract.unit' , 'contract.renter', 'contract.unit.estate')->find($renterId);
        if ($record) {
            $estateRecord = $record->contract->unit->estate;
            $estateEntity= new EstateEntity(
                id: $estateRecord->id,
                name: $estateRecord->name,
                address: $estateRecord->address,
                floorCount: $estateRecord->floor_count,
            );
            $unitRecord= $record->contract->unit;
            $unitEntity= new UnitEntity(
                id : $unitRecord->id,
                estateId : $estateEntity->id,
                number : $unitRecord->number,
                floorNumber : $unitRecord->floor_number,
                type : UnitType::from($unitRecord->type),
                isEmpty : $unitRecord->is_empty ? true : false,
                estate : $estateEntity, 
            );
            $renterRecord = $record->contract->renter;
            $renterEntity = new RenterEntity(
                id : $renterRecord->id,
                name : $renterRecord->name,
                identityType : RenterIdentityType::from($renterRecord->identity_type),
                identityNumber : $renterRecord->identity_number,
                phones : $renterRecord->phones->pluck('phone')->toArray(),
                notes : $renterRecord->notes,
            );
            $unitContractRecord = $record->contract;
            $unitContractEntity = new UnitContractEntity(
                id : $unitContractRecord->id,
                unitId : $unitContractRecord->unit_id,
                renterId : $unitContractRecord->renter_id,
                type : UnitContractType::from($unitContractRecord->type),
                rentValue : $unitContractRecord->rent_value,
                annualRentIncreasement : $unitContractRecord->annual_rent_increasement,
                insuranceValue : $unitContractRecord->insurance_value,
                startDate : CarbonDateUtility::from($unitContractRecord->start_date),
                endDate : CarbonDateUtility::from($unitContractRecord->end_date),
                waterInvoicePercentage : $unitContractRecord->water_invoice_percentage,
                electricityInvoicePercentage : $unitContractRecord->electricity_invoice_percentage, 
                renter : $renterEntity,
                unit : $unitEntity,
            );
            $transactionRecord = $record->transaction;
            $transactionEntity = new TransactionEntity(
                id : $transactionRecord->id,
                date : CarbonDateUtility::from($transactionRecord->date),
                amount : $transactionRecord->amount,
                description : $transactionRecord->description,
            );
            $transactionEntity->setDirection(); // *setter  [Withdraw or Deposite]
            // final object
            return new RentInvoiceEntity(
                id:$record->id,
                transactionId:$record->transaction_id,
                contractId:$record->contract_id,
                forMonth:$record->for_month,
                forYear:$record->for_year,
                transaction:$transactionEntity, 
                contract:$unitContractEntity, 
            );
        }
        return null;
    }
    public function update(RentInvoiceEntity $RentInvoiceEntity): bool
    {
        return RentInvoice::find($RentInvoiceEntity->id)->update(
            [
            'for_month' => $RentInvoiceEntity->forMonth,
            'for_year' => $RentInvoiceEntity->forYear,
            ]
        );
    }
    public function destroy(int $renterId): bool
    {
        return RentInvoice::find($renterId)->delete();
    }
}
