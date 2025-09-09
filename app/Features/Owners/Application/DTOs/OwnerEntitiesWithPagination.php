<?php
declare (strict_types= 1);

namespace App\Features\Owners\Application\DTOs;

use App\Shared\Application\DTOs\EntitiesWithPagination;
use App\Shared\Domain\Entities\OwnerEntity;

/**
 * @extends EntitiesWithPagination<OwnerEntity> 
 */
final class OwnerEntitiesWithPagination extends EntitiesWithPagination{ }