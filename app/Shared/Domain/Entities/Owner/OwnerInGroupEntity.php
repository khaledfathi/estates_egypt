<?php
declare(strict_types=1);

namespace App\Shared\Domain\Entities\Owner;

use App\Models\OwnerGroup;

class OwnerInGroupEntity {
    public function __construct(
        public ?int $id = null,
        public ?int $ownerId= null,
        public ?int $groupId= null,
        public ?OwnerEntity $owner = null,
        public ?OwnerGroup $ownerGroup = null,
    ){}
}
