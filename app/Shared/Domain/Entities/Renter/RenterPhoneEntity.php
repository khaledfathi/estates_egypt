<?php
declare(strict_types= 1);
namespace App\Shared\Domain\Entities\Renter;


final class RenterPhoneEntity {
    public function __construct(
        public ?int $id=null,
        public ?int $renterId=null,
        public ?string $phone=null,
    ){ }
}