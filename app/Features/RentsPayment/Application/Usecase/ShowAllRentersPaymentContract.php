<?php
declare(strict_types=1);
namespace App\Features\RentsPayment\Application\Usecase;

use App\Features\RentsPayment\Application\Contracts\ShowAllRentersPaymentContract as ContractsShowAllRentersPaymentContract;
use App\Features\RentsPayment\Application\Outputs\ShowAllRentersPaymentOutput;
use App\Shared\Domain\Repositories\RenterPaymentRepository;
use App\Shared\Domain\Repositories\UnitContractRepository;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use Exception;

class ShowAllRentersPaymentContract implements ContractsShowAllRentersPaymentContract {
    public function __construct(
        private readonly UnitContractRepository $unitContractRepository,
        private readonly RenterPaymentRepository $renterPaymentRepository,
    ){}
    public function execute(int $contractId , ShowAllRentersPaymentOutput $presenter): void{

        try {
            $unitContractEntity = $this->unitContractRepository->show($contractId);
            $presenter->onSuccess($unitContractEntity , new EntitiesWithPagination ());
            //code...
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}

