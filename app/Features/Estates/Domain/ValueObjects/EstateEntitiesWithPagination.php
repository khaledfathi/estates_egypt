<?php
declare (strict_types= 1);

namespace App\Features\Estates\Domain\ValueObjects;

use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

/**
 * @extends EntitiesWithPagination<EstateEntity> 
 */
final class EstateEntitiesWithPagination  extends EntitiesWithPagination{ }
