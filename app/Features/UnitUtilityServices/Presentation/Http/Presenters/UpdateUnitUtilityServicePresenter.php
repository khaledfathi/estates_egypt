<?php

declare(strict_types=1);

namespace App\Features\UnitUtilityServices\Presentation\Http\Presenters;

use App\Features\UnitUtilityServices\Application\Outputs\UpdateUnitUtilityServiceOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class UpdateUnitUtilityServicePresenter implements UpdateUnitUtilityServiceOutput
{

    private Closure $response;
    private $lastPage;
    public function __construct(
        private readonly int $estateId,
        private readonly int $unitId,
    ) {

        $this->handleSession();
    }
    private function handleSession()
    {
        $this->lastPage = session(SessionKeys::UNIT_UTILITY_SERVICE_EDIT_PREVIOUS_PAGE);
    }
    public function onSuccess(bool $status): void
    {
        $this->response = fn() => redirect($this->lastPage);
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
