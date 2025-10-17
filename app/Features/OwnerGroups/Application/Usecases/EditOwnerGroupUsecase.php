<?php
declare (strict_types=1);
namespace App\Features\OwnerGroups\Application\Usecases;

use App\Features\OwnerGroups\Application\Contracts\EditOwnerGroupContract;
use App\Features\OwnerGroups\Application\Outputs\EditOwnerGroupsOutput;
use App\Shared\Domain\Repositories\OwnerGroupRepository;
use Exception;

final class EditOwnerGroupUsecase implements EditOwnerGroupContract {
    public function __construct(
        private readonly OwnerGroupRepository $ownerGroupRepository
    ) {}
    public function execute(int $ownerGroupId, EditOwnerGroupsOutput $presneter): void{
        try {
            $record = $this->ownerGroupRepository->show($ownerGroupId);
            $record
                ? $presneter->onSuccess($record)
                : $presneter->onNotFound();
        } catch (Exception $e) {
            $presneter->onFailure($e->getMessage());
        }

    }

}