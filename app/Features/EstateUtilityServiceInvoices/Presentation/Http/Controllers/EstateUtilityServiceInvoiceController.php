<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServiceInvoices\Presentation\Http\Controllers;

use App\Features\EstateUtilityServiceInvoices\Application\Contracts\CreateEstateUtilityServiceInvoiceContract;
use App\Features\EstateUtilityServiceInvoices\Application\Contracts\DestroyEstateUtilityServiceInvoiceContract;
use App\Features\EstateUtilityServiceInvoices\Application\Contracts\DownloadEstateUtilityServiceInvoiceFileContract;
use App\Features\EstateUtilityServiceInvoices\Application\Contracts\EditEstateUtilityServiceInvoiceContract;
use App\Features\EstateUtilityServiceInvoices\Application\Contracts\StoreEstateUtilityServiceInvoiceContract;
use App\Features\EstateUtilityServiceInvoices\Application\Contracts\UpdateEstateUtilityServiceInvoiceContract;
use App\Features\EstateUtilityServiceInvoices\Presentation\Http\Presenters\CreateEstateUtilityServiceInvoicePresenter;
use App\Features\EstateUtilityServiceInvoices\Presentation\Http\Presenters\DestroyEstateUtilityServiceInvoicePresenter;
use App\Features\EstateUtilityServiceInvoices\Presentation\Http\Presenters\DownloadEstateUtilityServiceInvoiceFilePresenter;
use App\Features\EstateUtilityServiceInvoices\Presentation\Http\Presenters\EditEstateUtilityServiceInvoicePresenter;
use App\Features\EstateUtilityServiceInvoices\Presentation\Http\Presenters\StoreEstateUtilityServiceInvoicePresenter;
use App\Features\EstateUtilityServiceInvoices\Presentation\Http\Presenters\UpdateEstateUtilityServiceInvoicePresenter;
use App\Features\EstateUtilityServiceInvoices\Presentation\Http\Presenters\ViewEstateUtilityServiceInvoiceFilePresenter;
use App\Features\EstateUtilityServiceInvoices\Presentation\Http\Requests\StoreEstateUtilityServiceInvoiceRequest;
use App\Features\EstateUtilityServiceInvoices\Presentation\Http\Requests\UpdateEstateUtilityServiceInvoiceRequest;
use App\Http\Controllers\Controller;
use App\Shared\Application\Contracts\Storage\File;
use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\Entities\Estate\EstateUtilityServiceInvoiceEntity;
use App\Shared\Infrastructure\Storage\LaravelFile;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class EstateUtilityServiceInvoiceController extends Controller
{
    public function __construct(
        private readonly CreateEstateUtilityServiceInvoiceContract $createEstateUtilityServiceInvoiceUsecase,
        private readonly StoreEstateUtilityServiceInvoiceContract $storeEstateUtilityServiceInvoiceUsecase,
        private readonly DestroyEstateUtilityServiceInvoiceContract $destroyEstateUtilityServiceInvoiceUsecase,
        private readonly DownloadEstateUtilityServiceInvoiceFileContract $downloadEstateUtilityServiceInvoiceFileUsecase,
        private readonly EditEstateUtilityServiceInvoiceContract $editEstateUtilityServiceInvoiceUsecase,
        private readonly UpdateEstateUtilityServiceInvoiceContract $updateEstateUtilityServiceInvoiceUsecase, 

    ) {}
    public function create(string $estateId, string  $utilitServiceId)
    {
        $presenter = new CreateEstateUtilityServiceInvoicePresenter();
        $this->createEstateUtilityServiceInvoiceUsecase->execute((int)$utilitServiceId, $presenter);
        return $presenter->handle();
    }
    public function store(StoreEstateUtilityServiceInvoiceRequest $request, string $estateId, string  $utilityServiceId)
    {
        //prepare data 
        $utilityServiceInvoice = $this->formToUtilityServiceInvoice([
            ...$request->all(),
            'estate_id' => (int)$estateId,
            'utility_service_id' => $utilityServiceId
        ]);
        $file = $this->fileDTO($request->file('file'));
        //action
        $presenter = new StoreEstateUtilityServiceInvoicePresenter((int)$estateId, (int)$utilityServiceId);
        $this->storeEstateUtilityServiceInvoiceUsecase->execute(
            $utilityServiceInvoice,
            $file,
            $presenter
        );
        return $presenter->handle();
    }
    public function edit(string $estateId, string $utilityServicecId, string $invoiceId)
    {
        $presenter = new EditEstateUtilityServiceInvoicePresenter();
        $this->editEstateUtilityServiceInvoiceUsecase->execute((int)$invoiceId, $presenter);
        return $presenter->handle();
    }
    public function update(UpdateEstateUtilityServiceInvoiceRequest $request, string $estateId, string  $utilityServiceId, string $invoiceId)
    {
        //prepeare data 
        $estateUtilityServiceinvoiceEntity = $this->formToUtilityServiceInvoice([
            ...$request->all(),
            'invoice_id' => (int)$invoiceId,
            'estate_id' => (int)$estateId,
            'utility_service_id' => $utilityServiceId
        ]);
        $file = $this->fileDTO($request->file('file'));
        //action 
        $presenter = new UpdateEstateUtilityServiceInvoicePresenter((int)$estateId , (int)$utilityServiceId);
        $this->updateEstateUtilityServiceInvoiceUsecase->execute( $estateUtilityServiceinvoiceEntity , $file, $presenter);
        return $presenter->handle();
    }
    public function destroy(string $estateId, string $utilityServiceId, string $invoiceId)
    {
        $presenter = new DestroyEstateUtilityServiceInvoicePresenter();
        $this->destroyEstateUtilityServiceInvoiceUsecase->execute((int) $invoiceId, $presenter);
        return $presenter->handle();
    }
    public function viewFile(string $estateId, string  $utilityServiceId, string $invoiceId, string $file)
    {
        $presenter = new ViewEstateUtilityServiceInvoiceFilePresenter();
        $this->downloadEstateUtilityServiceInvoiceFileUsecase->execute((int)$estateId, (int)$utilityServiceId, $file, $presenter);
        return $presenter->handle();
    }
    public function download(string $estateId, string  $utilityServiceId, string $invoiceId, string $file)
    {
        $presenter = new DownloadEstateUtilityServiceInvoiceFilePresenter();
        $this->downloadEstateUtilityServiceInvoiceFileUsecase->execute((int)$estateId, (int)$utilityServiceId, $file, $presenter);
        return $presenter->handle();
    }
    private function formToUtilityServiceInvoice(array $formArray): EstateUtilityServiceInvoiceEntity
    {
        return new EstateUtilityServiceInvoiceEntity(
            id: $formArray['invoice_id'] ?? null,
            estateUtilityServiceId: (int)$formArray['utility_service_id'] ?? null,
            amount: (int)$formArray['amount'] ?? null,
            forMonth: (int) $formArray['for_month'] ?? null,
            forYear: (int) $formArray['for_year'] ?? null,
            estate: new EstateEntity(id: (int)$formArray['estate_id'] ?? null),
        );
    }
    private function fileDTO(?UploadedFile $file): ?File
    {
        return $file
            ? new LaravelFile(
                $file->getClientOriginalName(),
                $file->getClientOriginalExtension(),
                $file->getMimeType(),
                $file->getPathname(),
                $file->getContent(),
            )
            : null;
    }
}
