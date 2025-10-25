<?php

declare(strict_types=1);

namespace App\Features\UnitOwnerships\Presentation\Http\Presenters;

use App\Features\UnitOwnerships\Application\Outputs\StoreUnitOwnershipsOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class StoreUnitOwnershipPresenter implements StoreUnitOwnershipsOutput
{
    public Closure $response;
    public function __construct(
        private readonly int $estateId,
        private readonly int $unitId,
    ) {}
    public function onSuccess(array $unitOwnershipEntities): void
    {
        $this->response = fn() =>
        redirect(route('estates.units.show', ['estate' => $this->estateId, 'unit' => $this->unitId]))
            ->with('success', Messages::STORE_SUCCESS);
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() => back()
            ->withInput()
            ->with('error', Messages::INTERNAL_SERVER_ERROR);
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
