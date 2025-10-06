<?php
declare (strict_types= 1);

namespace App\Features\Units\Domain\ValueObjects; 

use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

/**
 * @extends EntitiesWithPagination<UnitEntity> 
 */
final class UnitEntitiesWithPagination extends EntitiesWithPagination{ }