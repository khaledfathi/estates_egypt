<?php
declare (strict_types= 1);

namespace App\Features\Owners\Application\DTOs;

use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Domain\Entities\Owner\OwnerEntity;

/**
 * @extends EntitiesWithPagination<OwnerEntity> 
 */
final class OwnerEntitiesWithPagination extends EntitiesWithPagination{ }
