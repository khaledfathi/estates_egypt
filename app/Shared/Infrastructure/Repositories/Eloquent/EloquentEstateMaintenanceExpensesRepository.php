<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent;

use App\Models\EstateMaintenanceExpenses;
use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\Entities\Estate\EstateMaintenanceExpensesEntity;
use App\Shared\Domain\Entities\Transaction\TransactionEntity;
use App\Shared\Domain\Repositories\EstateMaintenanceExpensesRepository;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Domain\ValueObjects\Pagination;
use App\Shared\Infrastructure\Utilities\CarbonDateUtility;

final class EloquentEstateMaintenanceExpensesRepository implements EstateMaintenanceExpensesRepository
{
    /**
     * @return array<EstateMaintenanceExpensesEntity> 
     */
    public function index(): array
    {
        return  [];
    }
    /**
     * @param int $perPage
     * @return EntitiesWithPagination<EstateMaintenanceExpensesEntity> 
     */
    public function indexWithPaginateByEstateId(int $estateId, int $perPage): EntitiesWithPagination
    {
        $records =  EstateMaintenanceExpenses::where('estate_id', $estateId)
            ->with('estate', 'transaction')->paginate();

        //estate maintenance expenses DTO 
        $estateMaintenanceExpensesEntities = [];
        foreach ($records as $key => $record) {
            //estate DTO
            $estateEntity = new EstateEntity(
                id: $record->estate->id,
                name: $record->estate->name,
                address: $record->estate->address,
                floorCount: $record->estate->floor_count,
            );
            //transaction DTO
            $transactionEntity = new TransactionEntity(
                id: $record->transaction->id,
                date: CarbonDateUtility::from($record->transaction->date),
                amount: $record->transaction->amount,
                description: $record->transaction->description,
            );
            $transactionEntity->setDirection();

            //estate maintenance expenses DTO 
            $estateMaintenanceExpensesEntities[] = new EstateMaintenanceExpensesEntity(
                id: $record->id,
                estateId: $record->estate_id,
                title: $record->title,
                description: $record->description,
                estate: $estateEntity,
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
        // 
        return new EntitiesWithPagination(
            $paginationData,
            $estateMaintenanceExpensesEntities,
        );
    }
    public function store(EstateMaintenanceExpensesEntity $estateMaintenanceExpensesEntity): EstateMaintenanceExpensesEntity
    {
        $record = EstateMaintenanceExpenses::create([
            'transaction_id' =>  $estateMaintenanceExpensesEntity->transaction->id,
            'estate_id' => $estateMaintenanceExpensesEntity->estateId,
            'title' => $estateMaintenanceExpensesEntity->title,
            'description' => $estateMaintenanceExpensesEntity->description
        ]);
        $estateMaintenanceExpensesEntity->id = $record->id;
        return $estateMaintenanceExpensesEntity;
    }
    public function show(int $estateMaintenanceExpensesId): EstateMaintenanceExpensesEntity|null
    {
        $record = EstateMaintenanceExpenses::with('estate', 'transaction')->find($estateMaintenanceExpensesId);
        if ($record) {
            //estate DTO
            $estateEntity = new EstateEntity(
                id: $record->estate->id,
                name: $record->estate->name,
                address: $record->estate->address,
                floorCount: $record->estate->floor_count,
            );
            //transaction DTO
            $transactionEntity = new TransactionEntity(
                id: $record->transaction->id,
                date: CarbonDateUtility::from($record->transaction->date),
                amount: $record->transaction->amount,
                description: $record->transaction->description,
            );
            $transactionEntity->setDirection();
            //final entity DTO
            return new EstateMaintenanceExpensesEntity(
                id: $record->id,
                estateId: $record->estate_id,
                title: $record->title,
                description: $record->description,
                estate: $estateEntity,
                transaction: $transactionEntity,
            );
        }
        return null;
    }
    public function update(EstateMaintenanceExpensesEntity $estateMaintenanceExpensesEntity): bool
    {
        return EstateMaintenanceExpenses::find($estateMaintenanceExpensesEntity->id)
            ->update([
                'estate_id' => $estateMaintenanceExpensesEntity->estateId,
                'title' => $estateMaintenanceExpensesEntity->title,
                'description' => $estateMaintenanceExpensesEntity->description
            ]);
    }
    public function destroy(int $estateMaintenanceExpensesId): bool
    {
        return EstateMaintenanceExpenses::find($estateMaintenanceExpensesId)->delete();
    }
}
