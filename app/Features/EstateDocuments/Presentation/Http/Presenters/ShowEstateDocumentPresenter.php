<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Presentation\Http\Presenters;

use App\Features\EstateDocuments\Application\Outputs\ShowEstateDocumentOutput;
use App\Shared\Application\Contracts\Storage\StorageDir;
use App\Shared\Application\Utility\UtilityStorageDir;
use App\Shared\Domain\Entities\Estate\EstateDocumentEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class ShowEstateDocumentPresenter  implements ShowEstateDocumentOutput
{

    private Closure $response;
    public function __construct(
        private readonly StorageDir $storageDir = new UtilityStorageDir(),
    ) {
        $this->handleSession();
    }
    private function handleSession()
    {
        $previousPage = SessionKeys::ESTATE_DOCUMENT_EDIT_PREVIOUS_PAGE;
        session()->put($previousPage, url()->current());
    }
    public function onSuccess(EstateDocumentEntity  $estateDocumentEntity): void
    {
        $data = [
            'estateDocument' => $estateDocumentEntity,
            'estate' => $estateDocumentEntity->estate,
        ];
        $this->response = fn() => view('estates.documents::show', $data);
    }
    public function onNotFount(): void
    {
        $this->response = fn() => view("estates.documents::show", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(String $error): void
    {
        $this->response = fn() => view("estates.documents::show", [
            'error' => Messages::INTERNAL_SERVER_ERROR,
        ]);
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
