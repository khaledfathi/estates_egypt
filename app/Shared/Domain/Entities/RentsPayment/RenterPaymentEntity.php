<?php
declare (strict_types= 1);
namespace App\Features\RentsPayment\Presentation\Http\Controllers;


class RenterPaymentEntity {
    public function __construct(
        private ?int $id=null,
        private ?int $transactionId=null,
        private ?int $contractId=null,
        private ?int $forMonth=null,
        private ?int $forYear=null,
        private ?string $notes=null,
    ) { }
}