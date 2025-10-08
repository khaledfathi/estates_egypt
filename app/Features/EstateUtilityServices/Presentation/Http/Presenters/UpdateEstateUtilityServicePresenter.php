<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServices\Presentation\Http\Presenters;

use App\Features\EstateUtilityServices\Application\Outputs\UpdateEstateUtilityServiceOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

class UpdateEstateUtilityServicePresenter implements UpdateEstateUtilityServiceOutput
{
    private Closure $response;
    public function __construct(
        private readonly int $estateId,
    ) {}
    public function onSuccess(bool $status): void
    {
        $this->response = fn() => 
            redirect(route('estates.utility-services.index', ['estate' => $this->estateId]))
            ->with(['success' => Messages::UPDATE_SUCCESS]);
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() =>
        redirect()->back()->withErrors(Messages::INTERNAL_SERVER_ERROR);
        //log
        Log::channel(LogChannels::ERROR)->error(
            'Databse failure',
            ['error' => $error, 'error_source' => __CLASS__ . '::' . __FUNCTION__]
        );
    }
    public function handle()
    {
        return ($this->response)();
    }
}
