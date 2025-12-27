<?php

declare(strict_types=1);

namespace App\Features\RentInvoices\Presentation\Http\Presenters;

use App\Features\RentInvoices\Application\Outputs\StoreRentInvoiceOutput;
use App\Shared\Domain\Entities\RentInvoice\RentInvoiceEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class StoreRentInvoicePresenter implements StoreRentInvoiceOutput
{
    public Closure $response;
    public function __construct(
        private readonly int $estateId,
        private readonly int $unitId,
        private readonly int $contractId,
    ) {}
    public function onSuccess(RentInvoiceEntity $rentInvoiceEntity): void
    {
        $this->response = fn() => redirect(route('estates.units.contracts.rent-invoices.index', [
            'estate' => $this->estateId,
            'unit' => $this->unitId,
            'contract' => $this->contractId
        ]));
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() => back()
            ->withInput()
            ->with('error', Messages::INTERNAL_SERVER_ERROR);
        //log
        Log::channel(LogChannels::ERROR)->error(
            'Databse failure',
            ['error' => $error,  'error_source' => __CLASS__ . '::' . __FUNCTION__]
        );
    }
    public function handle()
    {
        return ($this->response)();
    }
}
