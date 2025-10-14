<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entities\Owner;

final class OwnerGroupEntity
{
    public function __construct(
        public ?int $id = null,
        public ?string $name = null,
    ) {}

    /**
     * prevent delete the default ownerGroup 
     * @param int $ownerGroupOId
     * @return bool
     */
    public static function canBeDeleted (int $ownerGroupOId):bool{
        return $ownerGroupOId == 1 ? false :  true;
    }
}
