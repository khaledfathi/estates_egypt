<?php 
declare(strict_types= 1);
namespace App\Shared\Domain\Entities;

final class OwnerEntity {
    public function __construct(
        public ?int $id = null, 
        public ?string $name = null, 
        public ?string $nationalId = null, 
        public ?string $address = null, 
        public ?array $phones= null, 
        public ?string $notes = null, 
    ) {}
    public static  function fromAssociativeArray (array $array):self{
        $obj = new self();
        foreach ($array as $key => $value) {
            if (property_exists(self::class , $key)) {
                $obj->{$key} = $value;    
            }
        }
        return $obj;
    }

    public function toArray (): array {
        return [
            "id"=> $this->id,
            "name"=> $this->name,
            "nationalId"=> $this->nationalId,
            "address"=> $this->address,
            "phones"=> $this->phones,
            "notes"=> $this->notes,
        ];
    }
}