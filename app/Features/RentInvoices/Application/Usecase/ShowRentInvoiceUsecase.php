<?php

declare(strict_types=1);

namespace App\Features\RentInvoices\Application\Usecase;

use App\Features\RentInvoices\Application\Contracts\ShowRentInvoiceContract;
use App\Features\RentInvoices\Application\Outputs\ShowRentInvoiceOutput;
use App\Shared\Domain\Repositories\RentInvoiceRepository;
use Exception;

final class ShowRentInvoiceUsecase implements ShowRentInvoiceContract
{
    public function __construct(
        private readonly RentInvoiceRepository $rentInvoiceRepository,
    ) {}
    public function execute(int $rentInvoiceId, ShowRentInvoiceOutput $presenter): void
    {
        try {
            $rentInvoiceEntity = $this->rentInvoiceRepository->show($rentInvoiceId);
            $rentInvoiceEntity
                ? $presenter->onSuccess($rentInvoiceEntity)
                : $presenter->onNotFound();
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
