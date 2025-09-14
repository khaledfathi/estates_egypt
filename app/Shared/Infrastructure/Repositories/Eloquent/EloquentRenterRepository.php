<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent;

use App\Features\Renters\Application\DTOs\RenterEntitiesWithPagination;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Domain\Entities\Renter\RenterEntity;
use App\Shared\Domain\Entities\Renter\RenterPhoneEntity;
use App\Shared\Domain\Enum\Renter\RenterIdentityType;
use App\Shared\Domain\Repositories\RenterRepositroy;
use App\Shared\Domain\ValueObjects\Pagination;
use App\Shared\Infrastructure\Models\Renter\Renter;
use App\Shared\Infrastructure\Models\Renter\RenterPhone;

final class EloquentRenterRepository implements RenterRepositroy
{
    /**
     * 
     * @inheritDoc   
     */
    public function index ():array
    {
        return []; 
    }
    public function indexWithPaginate(int $perPage): EntitiesWithPagination{
        $renterRecords= Renter::with('phones')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        //Transform to DTO
        $arrayOfRenters= [];
        foreach ($renterRecords as $record) {
            //phones DTO
            $renterPhones = [];
            foreach ($record?->phones ?? [] as $phone) {
                $renterPhones[]  =  new RenterPhoneEntity(
                     (int)$phone->id,
                     (int)$phone->renter_id,
                     $phone->phone,
                 );
            }
            //owner DTO
            $arrayOfRenters[] = new RenterEntity(
                (int) $record->id,
                $record->name,
                RenterIdentityType::from($record->identity_type),
                $record->identity_number,
                $renterPhones, 
                $record->notes,
            );
        }
        //Pagination DTO
        $paginationData = new Pagination(
            perPage: $renterRecords->perPage(),
            currentPage: $renterRecords->currentPage(),
            path: $renterRecords->path(),
            pageName: $renterRecords->getPageName(),
            total: $renterRecords->total()
        );
        //Final DTO
        $arrayOfRentersWithPagination = new RenterEntitiesWithPagination(
            pagination: $paginationData,
            entities: $arrayOfRenters,
        );
        return $arrayOfRentersWithPagination;
    }
    public function store (RenterEntity $renterEntity):RenterEntity {
        $renterRecord = Renter::create([
            'name' => $renterEntity->name,
            'identity_type' => $renterEntity->identityType->value,
            'identity_number' => $renterEntity->identityNumber,
            'notes' => $renterEntity->notes,
        ]);
        foreach ($renterEntity->phones as $phone) {
            $phoneRecord = RenterPhone::create([
                'renter_id' => $renterRecord->id,
                'phone' => $phone->phone,
            ]);
            $phone->id = $phoneRecord->id;
            $phone->renterId = $renterRecord->id;
        }
        $renterEntity->id = $renterRecord->id;
        return $renterEntity;
    }

    public function show (int $renterId):RenterEntity|null
    {
        $record = Renter::with('phones')->find($renterId);
        if ($record) {
            $ownerPhones=[];
            foreach ($record?->phones ?? [] as $phone) {
                $ownerPhones[]  =  new RenterPhoneEntity(
                    (int)$phone->id,
                    (int)$phone->owner_id,
                    $phone->phone,
                );
            }
            $ownerEntity = new RenterEntity(
                $record->id,
                $record->name,
                RenterIdentityType::from($record->identity_type),
                $record->identity_number,
                $ownerPhones,
                $record->notes
            );
            return $ownerEntity;
        }
        return null;
    }
    public function update (RenterEntity $renterEntity):bool{
        $find = Renter::with('phones')->find($renterEntity->id);
        if ($find) {
            //update record
            $updateStatus = $find->update([
                'name' => $renterEntity->name,
                'identity_type' => $renterEntity->identityType->value,
                'identity_number' => $renterEntity->identityNumber,
                'notes' => $renterEntity->notes,
            ]);

            // *- update phone releated to this owner record
            // 1- delete current phones 
            RenterPhone::where('renter_id', $renterEntity->id)->delete();
            // 2- store new phones 
            foreach ($renterEntity->phones as $phone) {
                RenterPhone::create([
                    'renter_id' => $renterEntity->id,
                    'phone' => $phone->phone,
                ]);
            }
            return $updateStatus;
        }
        return false;
    }
    public function destroy (int $renterId):bool{
        return Renter::find($renterId)->delete();
    }
}
