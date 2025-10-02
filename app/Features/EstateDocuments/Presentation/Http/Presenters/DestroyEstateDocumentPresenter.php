<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Presentation\Http\Presenters;

use App\Features\EstateDocuments\Application\Outputs\DestroyEstateDocumentOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class DestroyEstateDocumentPresenter implements DestroyEstateDocumentOutput
{
    private Closure $response;
    public  function  __construct(private readonly int $estateId) {}
    public function onSuccess(bool $status): void
    {
        $this->response = fn() =>
        redirect(route('estates.documents.index', ['estate' => $this->estateId]))
            ->with('success', Messages::DESTROY_SUCCESS);
    }
    public function onFailure($error): void
    {
        $this->response = fn() => back()->withErrors([
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
