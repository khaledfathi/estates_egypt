<?php

declare(strict_types=1);

namespace App\Features\RentInvoices\Presentation\Http\Controllers;

use App\Features\RentInvoices\Application\Contracts\CreateRentInvoiceContract;
use App\Features\RentInvoices\Application\Contracts\DestroyRentInvoiceContract;
use App\Features\RentInvoices\Application\Contracts\EditRentInvoiceContract;
use App\Features\RentInvoices\Application\Contracts\ShowAllRentInvoicesContract;
use App\Features\RentInvoices\Application\Contracts\ShowRentInvoiceContract;
use App\Features\RentInvoices\Application\Contracts\StoreRentInvoiceContract;
use App\Features\RentInvoices\Application\Contracts\UpdateRentInvoiceContract;
use App\Features\RentInvoices\Presentation\Http\Presenters\CreateRentInvoicePresenter;
use App\Features\RentInvoices\Presentation\Http\Presenters\DestroyRentInvoicePresenter;
use App\Features\RentInvoices\Presentation\Http\Presenters\EditRentInvoicePresenter;
use App\Features\RentInvoices\Presentation\Http\Presenters\ShowAllRentInvoicePresenter;
use App\Features\RentInvoices\Presentation\Http\Presenters\ShowRentInvoicePresenter;
use App\Features\RentInvoices\Presentation\Http\Presenters\StoreRentInvoicePresenter;
use App\Features\RentInvoices\Presentation\Http\Presenters\UpdateRentInvoicePresenter;
use App\Features\RentInvoices\Presentation\Http\Requests\StoreRentInvoiceRequest;
use App\Features\RentInvoices\Presentation\Http\Requests\UpdateRentInvoiceRequest;
use App\Http\Controllers\Controller;
use App\Shared\Domain\Entities\RentInvoice\RentInvoiceEntity;
use App\Shared\Domain\Entities\Transaction\TransactionEntity;
use App\Shared\Infrastructure\Utilities\CarbonDateUtility;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RentInvoiceController extends Controller
{
    public function __construct(
        private readonly ShowAllRentInvoicesContract $ShowAllRentInvoiceUsecase,
        private readonly CreateRentInvoiceContract $CreateRentInvoiceUsecase,
        private readonly StoreRentInvoiceContract $storeRentInvoiceUsecase,
        private readonly ShowRentInvoiceContract $showRentInvoiceUsecase, 
        private readonly EditRentInvoiceContract $editRentInvoiceUsecase,
        private readonly DestroyRentInvoiceContract $destroyRentInvoiceUsecase,
        private readonly UpdateRentInvoiceContract $updateRentInvoiceUsecase, 
    ) {}
    public function index(Request $request, string $estateId, string $unitId, string $contractId)
    {
        //prepare 
        $year= (int)($request->year ?? Carbon::now()->year);
        //action
        $presenter = new ShowAllRentInvoicePresenter($year);
        $this->ShowAllRentInvoiceUsecase->execute((int)$contractId, $year, $presenter);
        return $presenter->handle();
    }
    public function show(string $estateId ,string  $unitId ,string $contractId ,string $rentInvoicecId)
    {
        $presenter = new ShowRentInvoicePresenter();
        $this->showRentInvoiceUsecase->execute((int)$rentInvoicecId , $presenter);
        return $presenter->handle();
    }
    public function create(string $estateId, string $unitId, string $contractId)
    {
        $presenter = new CreateRentInvoicePresenter();
        $this->CreateRentInvoiceUsecase->execute((int) $contractId, $presenter);
        return $presenter->handle();
    }
    public function store(StoreRentInvoiceRequest $request, string $estateId, string $unitId, string $contractId)
    {
        //prepare data 
        $rentInvoiceEntity = $this->formToRentInvoiceEntity([...$request->all(), 'contract_id' => (int)$contractId]);
        //action 
        $presenter = new StoreRentInvoicePresenter((int)$estateId, (int)$unitId, (int)$contractId);
        $this->storeRentInvoiceUsecase->execute($rentInvoiceEntity , $presenter);
        return $presenter->handle();
    }
    public function edit(string $estateId, string $unitId, string $contractId, string $rentInvoiceId, )
    {
        $presenter = new EditRentInvoicePresenter();
        $this->editRentInvoiceUsecase->execute((int)$rentInvoiceId ,$presenter);
        return $presenter->handle();
    }
    public function update(UpdateRentInvoiceRequest $request , string $estateId , string $unitId,string $contractId,string $rentInvoiceId)
    {
        //prepare data 
        $rentInvoiceEntity = $this->formToRentInvoiceEntity([...$request->all() , 'rent_invoice_id' => $rentInvoiceId] );
        //action 
        $presenter = new UpdateRentInvoicePresenter();
        $this->updateRentInvoiceUsecase->execute($rentInvoiceEntity, $presenter);
        return $presenter->handle();
    }
    public function destroy(string $estateId, string $unitId, string $contractId, string $rentInvoiceId, )
    {
        $presenter = new DestroyRentInvoicePresenter();
        $this->destroyRentInvoiceUsecase->execute((int) $rentInvoiceId , $presenter);
        return $presenter->handle();
    }
    private function formToRentInvoiceEntity(array $formArray): RentInvoiceEntity
    {
        return new RentInvoiceEntity(
            id: isset($formArray['rent_invoice_id']) ? (int)$formArray['rent_invoice_id'] : null,
            transactionId: isset($formArray['transaction_id']) ? (int) $formArray['transaction_id'] : null,
            contractId: (int)$formArray['contract_id'] ?? null,
            forMonth: (int)$formArray['for_month'] ?? null,
            forYear: (int)$formArray['for_year'] ?? null,
            transaction: new TransactionEntity(
                id: isset($formArray['transaction_id']) ? (int) $formArray['transaction_id'] : null,
                date: CarbonDateUtility::now(),
                amount: (int)$formArray['amount'] ?? 0,
                description: $formArray['notes'] ?? null,
            )
        );
    }
}
