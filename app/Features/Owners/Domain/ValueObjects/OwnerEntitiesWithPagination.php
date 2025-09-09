<?php
declare (strict_types= 1);

namespace App\Features\Owners\Domain\ValueObjects; 

use App\Shared\Domain\Entities\OwnerEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

/**
 * @extends EntitiesWithPagination<OwnerEntity> 
 */
final class OwnerEntitiesWithPagination extends EntitiesWithPagination{ }