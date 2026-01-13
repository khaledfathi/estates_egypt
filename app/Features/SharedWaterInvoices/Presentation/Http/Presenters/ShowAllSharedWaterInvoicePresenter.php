<?php

declare(strict_types=1);

namespace App\Features\SharedWaterInvoices\Presentation\Http\Presenters;

use App\Features\SharedWaterInvoices\Application\Outputs\ShowAllSharedWaterInvoiceOutput;
use App\Shared\Domain\Entities\SharedWaterInvoice\SharedWaterInvoiceEntity;
use App\Shared\Domain\Entities\Unit\UnitContractEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class ShowAllSharedWaterInvoicePresenter implements ShowAllSharedWaterInvoiceOutput
{
    /**
     * Summary of onSuccess
     * @param array<SharedWaterInvoiceEntity> $sharedWaterInvoicesEntities
     * @return void
     */
    public function __construct(
        private readonly int $selectedYear,
    ) {
        $this->handleSession();
     }
    private Closure $response;
    private function handleSession()
    {
        $currentPage = request()->fullUrl(); 
        session()->put(SessionKeys::SHARED_WATER_INVOICE_CURRENT_INDEX_PAGE, $currentPage);
        session()->put(SessionKeys::SHARED_WATER_INVOICE_EDIT_PREVIOUS_PAGE, $currentPage);
    }
    public function onSuccess(UnitContractEntity $unitContract, array $sharedWaterInvoicesEntities): void
    {
        $data = [
            'estate' => $unitContract->unit->estate,
            'unit' => $unitContract->unit,
            'unitContract' => $unitContract,
            'renter' => $unitContract->renter,
            'sharedWaterInvoices' => $sharedWaterInvoicesEntities,
            'selectedYear' => $this->selectedYear,
        ];
        $this->response = fn() => view('shared-water-invoices::index', $data);
    }
    public function onContractNotFound(): void
    {
        $this->response = fn() => view(
            'shared-water-invoices::index',
            ['error' => Messages::DATA_NOT_FOUND]
        );
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() => view('units::index', [
            'error' => Messages::INTERNAL_SERVER_ERROR,
        ]);
        //log
        Log::channel(LogChannels::ERROR)->error('Databse failure', ['error' => $error, 'error_source' => __CLASS__ . '::' . __FUNCTION__]);
    }
    public function handle()
    {
        return ($this->response)();
    }
}
