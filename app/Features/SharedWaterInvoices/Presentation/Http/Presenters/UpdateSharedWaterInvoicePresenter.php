<?php
declare (strict_types=1);
namespace App\Features\SharedWaterInvoices\Presentation\Http\Presenters;

use App\Features\SharedWaterInvoices\Application\Outputs\UpdateSharedWaterInvoiceOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class UpdateSharedWaterInvoicePresenter implements UpdateSharedWaterInvoiceOutput {
    private Closure $response; 
    public function __construct(
        private readonly int $estateId , 
        private readonly int $unitId, 
        private readonly int $contractId , 
        private readonly int $sharedWaterInvoiceId, 
    ) { }
    public function onSuccess (bool $status):void {
        $this->response = fn()=> redirect(route('estates.units.contracts.shared-water-invoices.index', [
            'estate' => $this->estateId,
            'unit' => $this->unitId,
            'contract' => $this->contractId,
            'shared_water_invoice' => $this->sharedWaterInvoiceId,
        ]));
    }
    public function onFailure (string $error):void {
        $this->response = fn() =>
            redirect()->back()->withErrors(Messages::INTERNAL_SERVER_ERROR);
        //log
        Log::channel(LogChannels::ERROR)->error(
            'Databse failure',
            ['error' => $error,  'error_source' => __CLASS__ . '::' . __FUNCTION__]
        );
    }
    public function handle(){
        return ($this->response)();
    }
}
