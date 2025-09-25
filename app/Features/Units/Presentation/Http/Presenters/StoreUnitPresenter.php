<?php

declare(strict_types=1);

namespace App\Features\Units\Presentation\Http\Presenters;

use App\Features\Units\Application\Constants\QueryParams;
use App\Features\Units\Application\Ouputs\StoreUnitOutput;
use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class StoreUnitPresenter implements StoreUnitOutput
{
    private Closure $response;
    public function __construct(
        private readonly ?int $estateId,
    ) {}
    public function onSuccess(UnitEntity $unitEntity): void
    {
        $this->response = fn()=> redirect(route('units.index', [QueryParams::ESTATE_ID => $this->estateId]))
            ->with('success', Messages::STORE_SUCCESS);
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() => back () 
            ->withInput()
            ->with('error' , Messages::INTERNAL_SERVER_ERROR);
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
