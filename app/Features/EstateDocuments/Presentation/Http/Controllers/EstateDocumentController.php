<?php
declare (strict_types=1);
namespace App\Features\EstateDocuments\Presentation\Http\Controllers;

use App\Features\EstateDocuments\Application\Contracts\DestroyEstateDocumentContract;
use App\Features\EstateDocuments\Application\Contracts\ShowEstateDocumentContract;
use App\Features\EstateDocuments\Application\Contracts\StoreEstateDocumentContract;
use App\Features\EstateDocuments\Presentation\Http\Presenters\CreateEstateDocumentPresenter;
use App\Features\EstateDocuments\Presentation\Http\Presenters\DestroyEstateDocumentPresenter;
use App\Features\EstateDocuments\Presentation\Http\Presenters\ShowEstateDocumentPresenter;
use App\Features\EstateDocuments\Presentation\Http\Presenters\ShowEstateDocumentsPaginatePresenter;
use App\Features\EstateDocuments\Presentation\Http\Presenters\StoreEstateDocumentPresenter;
use App\Features\EstateDocuments\Presentation\Http\Requests\StoreEstateDocumentRequest;
use App\Http\Controllers\Controller;
use App\Shared\Application\Contracts\Storage\File;
use App\Shared\Domain\Entities\EstateDocument\EstateDocumentEntity;
use App\Shared\Infrastructure\Storage\LaravelFile;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class EstateDocumentController extends Controller
{
    public function __construct(
        private readonly ShowEstateDocumentContract $showEstateDocumentUsecase,
        private readonly StoreEstateDocumentContract $storeEstateDocumentUsecase,
        private readonly DestroyEstateDocumentContract $destroyEstateDocumentUsecase
    ) {}
    public function index(Request $request)
    {
        $presenter = new ShowEstateDocumentsPaginatePresenter();
        $this->showEstateDocumentUsecase->allWithPaginate($presenter, (int)$request->route('estate'), 5);
        return $presenter->handle();
    }

    public function create(Request $request)
    {
        $presenter = new CreateEstateDocumentPresenter();
        $this->storeEstateDocumentUsecase->create((int) $request->route('estate'), $presenter);
        return $presenter->handle();
    }

    public function store(StoreEstateDocumentRequest $request)
    {
        //prepeare data
        $estateDocumentEntity = $this->formToEstateDocumentEntity([...$request->all(), 'estate' => $request->route('estate')]);
        $file = $this->fileDTO($request->file('file'));
        //action 
        $presenter = new StoreEstateDocumentPresenter();
        $this->storeEstateDocumentUsecase->store($estateDocumentEntity, $file,  $presenter);
        return $presenter->handle();
    }

    public function show(string $estateId , string $estateDocumentId)
    {
        $presenter = new ShowEstateDocumentPresenter();
        $this->showEstateDocumentUsecase->showById((int) $estateDocumentId , $presenter);
        return  $presenter->handle();
    }

    public function edit(string $id)
    {
        return __CLASS__ . "::" . __FUNCTION__;
    }

    public function update(Request $request, string $id)
    {
        return __CLASS__ . "::" . __FUNCTION__;
    }

    public function destroy(string $estateId, string $estateDocumentId)
    {
        $presenter = new DestroyEstateDocumentPresenter((int)$estateId);
        $this->destroyEstateDocumentUsecase->destroy( (int) $estateDocumentId, $presenter);
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
                $file->getPathname(), // path with file 
                $file->getContent(),
            )
            : null;
    }
}
