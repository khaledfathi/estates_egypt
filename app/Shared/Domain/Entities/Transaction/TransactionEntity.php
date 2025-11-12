<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entities\Transaction;

use App\Shared\Domain\Contracts\DateProviderContract;
use App\Shared\Domain\Enum\Transaction\TransactionDirection;

final class TransactionEntity
{
    public function __construct(
        public ?int $id = null,
        public ?DateProviderContract $date = null,
        public ?TransactionDirection $direction = null,
        public ?int $amount = null,
        public ?string $description = null,
    ) {
        if ($this->amount != null && $direction == TransactionDirection::WITHDRAW) {
            $this->amount *= -1;
        }
    }
    public function setDirection()
    {
        ($this->amount != null && $this->amount < 0)
            ? $this->direction = TransactionDirection::WITHDRAW
            : $this->direction = TransactionDirection::DEPOSIT;
    }

    public function isWithdraw()
    {
        return $this->direction == TransactionDirection::WITHDRAW;
    }
    public function isDeposit()
    {
        return $this->direction == TransactionDirection::DEPOSIT;
    }
}
