<?php

declare(strict_types=1);

namespace App\Features\UnitOwnerships\Presentation\Http\Presenters;

use App\Features\UnitOwnerships\Application\Outputs\StoreUnitOwnershipOutput;
use App\Shared\Domain\Entities\Unit\UnitOwnershipEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class StoreUnitOwnershipPresenter implements StoreUnitOwnershipOutput
{
    public Closure $response;
    public function __construct(
        private readonly int $estateId,
        private readonly int $unitId,
    ) {}
    public function onSuccess(UnitOwnershipEntity $unitOwnershipEntity): void
    {
        $this->response = fn() => 
            redirect(route('estates.units.show', ['estate' => $this->estateId, 'unit' => $this->unitId]));
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
