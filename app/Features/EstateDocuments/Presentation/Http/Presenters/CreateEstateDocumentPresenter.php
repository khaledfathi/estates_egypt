<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Presentation\Http\Presenters;

use App\Features\EstateDocuments\Application\Outputs\CreateEstateDocumentOutput as OutputsCreateEstateDocumentOutput;
use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class CreateEstateDocumentPresenter implements OutputsCreateEstateDocumentOutput
{

    private Closure $response;
    public function onSuccess(EstateEntity $estateEntity)
    {
        $data = [
            'estate' => $estateEntity
        ];
        $this->response= fn() => view('estates.documents::create', $data);
    }
    public function onNotFound() {
        $this->response= fn() => view('estates.documents::create', [
            'error'=>Messages::DATA_NOT_FOUND
        ]);
    }
    public function onFailure(string $error)
    {
        $this->response = fn ()=> back()->withErrors([
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
