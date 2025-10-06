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
}
