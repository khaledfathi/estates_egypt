<?php
declare(strict_types=1);
namespace App\Features\RentsPayment\Application\Contracts;

use App\Features\RentsPayment\Application\Outputs\ShowAllRentersPaymentOutput;

interface ShowAllRentersPaymentContract {
    public function execute(int $contractId , ShowAllRentersPaymentOutput $presenter): void;
}

