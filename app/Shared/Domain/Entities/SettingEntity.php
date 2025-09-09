<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entities;

final class SettingEntity
{
    public function __construct(
        public ?int $id = null,
        public ?string $name= null,
        public ?string $value = null,
    ) {}
    public function toArray():array{
        return [
            'id' => $this->id,
            'key'=> $this->name,
            'value'=> $this->value
        ];
    }

    public static function fromArray(array $array):SettingEntity{
        $obj = new self();
        foreach ($array as $key => $value) {
            if (property_exists($obj, $key)) {
                $obj->{$key} = $value;
            }
        }
        return $obj;
    }
}
