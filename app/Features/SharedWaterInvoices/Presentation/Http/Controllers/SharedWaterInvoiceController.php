<?php

declare(strict_types=1);

namespace App\Features\SharedWaterInvoices\Presentation\Http\Controllers;

use App\Features\SharedWaterInvoices\Application\Contracts\EditSharedWaterInvoiceContract;
use App\Features\SharedWaterInvoices\Application\Contracts\ShowAllSharedWaterInvoiceContract;
use App\Features\SharedWaterInvoices\Application\Contracts\UpdateSharedWaterInvoiceContract;
use App\Features\SharedWaterInvoices\Presentation\Http\Presenters\EditSharedWaterInvoicePresenter;
use App\Features\SharedWaterInvoices\Presentation\Http\Presenters\ShowAllSharedWaterInvoicePresenter;
use App\Features\SharedWaterInvoices\Presentation\Http\Presenters\UpdateSharedWaterInvoicePresenter;
use App\Features\SharedWaterInvoices\Presentation\Http\Requests\UpdateSharedWaterInvoiceRequest;
use App\Shared\Domain\Entities\SharedWaterInvoice\SharedWaterInvoiceEntity;
use App\Shared\Domain\Entities\Transaction\TransactionEntity;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SharedWaterInvoiceController
{
    public function __construct(
        private readonly ShowAllSharedWaterInvoiceContract $showAllSharedWaterInvoiceUsecase,
        private readonly EditSharedWaterInvoiceContract $editSharedWaterInvoiceUsecase,
        private readonly UpdateSharedWaterInvoiceContract $updateSharedWaterInvoiceUsecase,
    ) {}
    public function index(Request $request , string $estateId, string $unitId, string $contractId)
    {
        //prepare 
        $year = (int)($request->year ?? Carbon::now()->year);
        //action
        $presenter = new ShowAllSharedWaterInvoicePresenter($year);
        $this->showAllSharedWaterInvoiceUsecase->execute((int)$contractId, $year, $presenter);
        return $presenter->handle();
    }
    public function show()
    {
        return __CLASS__ . "::" . __FUNCTION__;
    }
    public function create()
    {
        return __CLASS__ . "::" . __FUNCTION__;
    }
    public function  store()
    {
        return __CLASS__ . "::" . __FUNCTION__;
    }
    public function edit(string $estateId, string $unitId, string $contractId, string $sharedWaterInvoiceId)
    {
        $presenter = new EditSharedWaterInvoicePresenter();
        $this->editSharedWaterInvoiceUsecase->exectute((int)$sharedWaterInvoiceId, $presenter);
        return $presenter->handle();
    }
    public function update(UpdateSharedWaterInvoiceRequest $request, string $estateId, string $unitId, string $contractId, string $sharedWaterInvoiceId)
    {
        //prepare 
        $sharedWaterInvoiceEntity = $this->formToSharedWaterInvoiceEntity($request->all());
        $presenter = new UpdateSharedWaterInvoicePresenter();
        //action
        $this->updateSharedWaterInvoiceUsecase->exectute($sharedWaterInvoiceEntity, $presenter);
        return $presenter->handle();
    }
    public function destroy()
    {
        return __CLASS__ . "::" . __FUNCTION__;
    }
    private function formToSharedWaterInvoiceEntity(array $formArray): SharedWaterInvoiceEntity
    {
        $transactionId = isset($formArray['transaction_id']) ? (int)$formArray['transaction_id'] : null;
        return new SharedWaterInvoiceEntity(
            transactionId: $transactionId,
            transaction: new TransactionEntity(
                id: $transactionId,
                amount: isset($formArray['amount']) ? (int) $formArray['amount'] : null,
                description: $formArray['notes'],
            ),
        );
    }
}
