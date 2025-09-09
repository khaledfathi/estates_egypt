<?php 
declare(strict_types= 1);
namespace App\Shared\Domain\Entities;

final class OwnerPhoneEntity{
    public function __construct(
        public ?int $id = null, 
        public ?int $ownerId= null, 
        public ?string $phone = null, 
    ) {}
    public function toArray (): array {
        return [
            "id"=> $this->id,
            "owner"=> $this->ownerId,
            "phone"=> $this->phone,
        ];
    }
    public static  function fromAssociativeArray (array $array):self{
        $obj = new self();
        foreach ($array as $key => $value) {
            if (property_exists(self::class , $key)) {
                $obj->{$key} = $value;    
            }
        }
        return $obj;
    }
}