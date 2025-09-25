<?php
declare(strict_types= 1);

namespace  App\Shared\Domain\Entities\Estate;

use App\Shared\Domain\Enum\Renter\EstateUtilityServiceType;

final class EstateUtilityServiceInvoiceEntity {
    public function __construct(
        public ?int $id=null ,
        public ?int $estateId=null ,
        public ?int $transactionId=null ,
        public ?EstateUtilityServiceType $type =null,
        public ?int $forMonth =null,
        public ?int $forYear=null,
    ){}
} 
