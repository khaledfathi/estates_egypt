<?php

declare(strict_types=1);

namespace App\Features\RentInvoices\Presentation\Http\Presenters;

use App\Features\RentInvoices\Application\Outputs\ShowAllRentInvoicesOutput;
use App\Shared\Domain\Entities\Unit\UnitContractEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use Closure;

final class ShowAllRentInvoicePresenter implements ShowAllRentInvoicesOutput
{
    private Closure $response;
    /**
     * @inheritDoc 
     */
    public function __construct(
        private readonly int $selectedYear,
    ) {
        $this->handleSession();
    }

    private function handleSession()
    {
        $currentPage = request()->fullUrl(); 
        session()->put(SessionKeys::RENT_INVOICE_CURRENT_INDEX_PAGE, $currentPage);
        session()->put(SessionKeys::RENT_INVOICE_EDIT_PREVIOUS_PAGE, $currentPage);
    }
    public function onSuccess(UnitContractEntity $unitContractEntity, EntitiesWithPagination $entitiesWithPagination): void
    {
        $data = [
            'unitContract' => $unitContractEntity,
            'renter' => $unitContractEntity->renter,
            'unit' => $unitContractEntity->unit,
            'estate' => $unitContractEntity->unit->estate,
            'rentInvoices' => $entitiesWithPagination->entities,
            'selectedYear' => $this->selectedYear,
        ];
        $this->response = fn() => view('rent-invoices::index', $data);
    }
    public function onContractNotFound(): void
    {
        dd('contract not found');
    }
    public function onFailure(string $error): void
    {
        dd('failure', $error);
    }
    public function handle()
    {
        return ($this->response)();
    }
}
