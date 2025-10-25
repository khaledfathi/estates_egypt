<?php
declare(strict_types= 1);

namespace  App\Shared\Domain\Entities\Estate;


final class EstateUtilityServiceInvoiceEntity {
    public function __construct(
        public ?int $id=null ,
        public ?int $estateUtilityServiceId=null ,
        public ?int $amount=null ,
        public ?int $forMonth =null,
        public ?int $forYear=null,
        public ?string $file=null,
        public ?EstateUtilityServiceEntity $estateUtilityService=null,
        public ?EstateEntity $estate=null,
    ){}
} 
