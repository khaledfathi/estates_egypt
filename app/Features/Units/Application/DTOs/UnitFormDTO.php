<?php

namespace App\Features\Units\Application\DTOs; 

use App\Shared\Domain\Entities\Estate\EstateEntity;

class  UnitFormDTO {
    /**
     * 
     * @param EstateEntity $estateEntity
     * @param array<string> $unitTypes
     * @param array<string> $unitOwnershipTypes
     * @param array<string> $unitIsEmptyLabels
     */
    public function __construct(
        public EstateEntity  $estateEntity , 
        public array $unitTypes,
        public array $unitOwnershipTypes, 
        public array $unitIsEmptyLabels
    ){}
}