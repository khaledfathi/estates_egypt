<?php 
declare(strict_types= 1);
namespace App\Shared\Domain\Entities\Owner; 

final class OwnerPhoneEntity{
    public function __construct(
        public ?int $id = null, 
        public ?int $ownerId= null, 
        public ?string $phone = null, 
    ) {}
}