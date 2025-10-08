<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Presentation\Http\Presenters;

use App\Features\EstateDocuments\Application\Outputs\StoreEstateDocumentOutput;
use App\Shared\Domain\Entities\Estate\EstateDocumentEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class StoreEstateDocumentPresenter implements StoreEstateDocumentOutput
{
    private Closure $response;
    public function onSuccess(EstateDocumentEntity $estateDocumentEntity): void
    {
        $this->response = fn() => 
            redirect(route('estates.documents.index', $estateDocumentEntity->estateId))
            ->with('success',  Messages::STORE_SUCCESS);
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() => back()->with('error', Messages::INTERNAL_SERVER_ERROR);
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
