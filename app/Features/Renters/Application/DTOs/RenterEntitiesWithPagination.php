<?php
declare (strict_types= 1);

namespace App\Features\Renters\Application\DTOs; 

use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Domain\Entities\Renter\RenterEntity;

/**
 * @extends EntitiesWithPagination<RenterEntity> 
 */
final class RenterEntitiesWithPagination extends EntitiesWithPagination{ }