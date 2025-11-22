<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Presentation\Http\Controllers;

use App\Features\EstateDocuments\Application\Contracts\CreateEstateDocumentContract;
use App\Features\EstateDocuments\Application\Contracts\DestroyEstateDocumentContract;
use App\Features\EstateDocuments\Application\Contracts\DownloadEstateDocumentFileContract;
use App\Features\EstateDocuments\Application\Contracts\EditEstateDocumentContract;
use App\Features\EstateDocuments\Application\Contracts\ShowEstateDocumentContract;
use App\Features\EstateDocuments\Application\Contracts\ShowEstateDocumentsPaginationContract;
use App\Features\EstateDocuments\Application\Contracts\StoreEstateDocumentContract;
use App\Features\EstateDocuments\Application\Contracts\UpdateEstateDocumentContract;
use App\Features\EstateDocuments\Presentation\Http\Presenters\CreateEstateDocumentPresenter;
use App\Features\EstateDocuments\Presentation\Http\Presenters\DestroyEstateDocumentPresenter;
use App\Features\EstateDocuments\Presentation\Http\Presenters\DownloadEstateDocumentFilePresenter;
use App\Features\EstateDocuments\Presentation\Http\Presenters\EditEstateDocumentPresenter;
use App\Features\EstateDocuments\Presentation\Http\Presenters\ShowEstateDocumentPresenter;
use App\Features\EstateDocuments\Presentation\Http\Presenters\ShowEstateDocumentsPaginatePresenter;
use App\Features\EstateDocuments\Presentation\Http\Presenters\StoreEstateDocumentPresenter;
use App\Features\EstateDocuments\Presentation\Http\Presenters\UpdateEstateDocumentPresenter;
use App\Features\EstateDocuments\Presentation\Http\Presenters\ViewEstateDocumentFilePresenter;
use App\Features\EstateDocuments\Presentation\Http\Requests\StoreEstateDocumentRequest;
use App\Features\EstateDocuments\Presentation\Http\Requests\UpdateEstateDocumentRequest;
use App\Http\Controllers\Controller;
use App\Shared\Application\Contracts\Storage\File;
use App\Shared\Application\Contracts\Storage\StorageDir;
use App\Shared\Domain\Entities\Estate\EstateDocumentEntity;
use App\Shared\Infrastructure\Storage\LaravelFile;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class EstateDocumentController extends Controller
{
    public function __construct(
        private readonly ShowEstateDocumentContract $showEstateDocumentUsecase,
        private readonly ShowEstateDocumentsPaginationContract $showPaginateEstateDocumentUsecase, 
        private readonly CreateEstateDocumentContract $createEstateDocumentUsecase,
        private readonly StoreEstateDocumentContract $storeEstateDocumentUsecase,
        private readonly DestroyEstateDocumentContract $destroyEstateDocumentUsecase,
        private readonly EditEstateDocumentContract $editEstateDocumentUsecase,
        private readonly UpdateEstateDocumentContract $updateEstateDocumentUsecase,
        private readonly DownloadEstateDocumentFileContract $downloadEstateDocumentFileUsecase,
    ) {}
    public function index(Request $request)
    {
        $presenter = new ShowEstateDocumentsPaginatePresenter();
        $this->showPaginateEstateDocumentUsecase->execute($presenter, (int)$request->route('estate'), 5);
        return $presenter->handle();
    }

    public function create(Request $request)
    {
        $presenter = new CreateEstateDocumentPresenter();
        $this->createEstateDocumentUsecase->execute((int) $request->route('estate'), $presenter);
        return $presenter->handle();
    }

    public function store(StoreEstateDocumentRequest $request)
    {
        //prepeare data
        $estateDocumentEntity = $this->formToEstateDocumentEntity([...$request->all(), 'estate' => $request->route('estate')]);
        $file = $this->fileDTO($request->file('file'));
        //action 
        $presenter = new StoreEstateDocumentPresenter();
        $this->storeEstateDocumentUsecase->execute($estateDocumentEntity, $file,  $presenter);
        return $presenter->handle();
    }

    public function show(string $estateId, string $estateDocumentId)
    {
        $presenter = new ShowEstateDocumentPresenter();
        $this->showEstateDocumentUsecase->execute((int) $estateDocumentId, $presenter);
        return  $presenter->handle();
    }

    public function edit(string $estateId, string $estateDocumentId)
    {
        $presenter = new EditEstateDocumentPresenter((int)$estateId );
        $this->editEstateDocumentUsecase->execute((int) $estateDocumentId, $presenter);
        return $presenter->handle();
    }

    public function update(UpdateEstateDocumentRequest $request, string $estateId, string $estateDocumentId)
    {
        //prepeare data 
        $estateDocumentEntity = $this->formToEstateDocumentEntity(
            [...$request->all(), 'estate' => (int)$estateId, 'id' => (int)$estateDocumentId]
        );
        $file = $this->fileDTO($request->file('file'));
        //action 
        $presenter = new UpdateEstateDocumentPresenter((int)$estateId, (int)$estateDocumentId);
        $this->updateEstateDocumentUsecase->execute($estateDocumentEntity, $file ,  $presenter);
        return $presenter->handle();
    }

    public function destroy(string $estateId, string $estateDocumentId)
    {
        $presenter = new DestroyEstateDocumentPresenter((int)$estateId);
        $this->destroyEstateDocumentUsecase->execute((int) $estateDocumentId, $presenter);
        return $presenter->handle();
    }

    public function download(string $estateId, string $file)
    {
        $presenter = new DownloadEstateDocumentFilePresenter();
        $this->downloadEstateDocumentFileUsecase->execute((int)$estateId, $file, $presenter);
        return $presenter->handle();
    }

    public function viewFile(string $estateId, string $file)
    {
        $presenter = new ViewEstateDocumentFilePresenter();
        $this->downloadEstateDocumentFileUsecase->execute((int)$estateId, $file, $presenter);
        return $presenter->handle();
    }

    private function formToEstateDocumentEntity(array $formArray): EstateDocumentEntity
    {
        return new EstateDocumentEntity(
            id: $formArray['id'] ?? null,
            estateId: (int)$formArray['estate'] ?? null,
            title: $formArray['title'] ?? null,
            description: $formArray['description'] ?? null,
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
