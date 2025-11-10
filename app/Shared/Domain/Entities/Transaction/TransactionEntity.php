<?php

declare(strict_types=1);

use App\Shared\Domain\Contracts\DateProviderContract;

final class TransactionEntity {
    public function __construct(
        public ?int $id = null,
        public ?DateProviderContract $date = null,
        public ?int $amount = null,
        public ?int $description = null,
    ){}
}