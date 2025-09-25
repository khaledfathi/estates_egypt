<?php

declare(strict_types=1);

namespace App\Features\Units\Presentation\Http\Presenters;

use App\Features\Units\Application\Ouputs\ShowUnitPaginateOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use Closure;
use Illuminate\Support\Facades\Log;

final class ShowUnitsPaginatePresenter implements ShowUnitPaginateOutput
{
    private Closure $response;
    /**
     * @inheritDoc 
     */

    // public function __construct()
    // {
    //     $this->handleSession();
    // }
    // private function handleSession()
    // {
    //     $currentPage = url()->current() . '?page=' . request('page');
    //     session()->put(SessionKeys::OWNER_CURRENT_INDEX_PAGE, $currentPage);
    //     session()->put(SessionKeys::OWNER_EDIT_PREVIOUS_PAGE, $currentPage);
    // }
    public function onSuccess(EntitiesWithPagination $unitEntitiesWithPagination, EstateEntity $estateEntity): void
    {
        $data = [
            'units' => $unitEntitiesWithPagination->entities,
            'estate' => $estateEntity,
            'pagination' => $unitEntitiesWithPagination->pagination,
        ];
        $this->response = fn() => view('units::index', $data);
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() => view('owners::index', [
            'error' => Messages::INTERNAL_SERVER_ERROR,
        ]);
        //log
        Log::channel(LogChannels::ERROR)->error('Databse failure', ['error' => $error, 'error_source' => __CLASS__ . '::' . __FUNCTION__]);
    }

    public function onEstateNotFound ():void {
    $this->response = fn() => view('units::index' , ['error' => Messages::DATA_NOT_FOUND ]);
    }
    public function handle()
    {
        return ($this->response)();
    }
}
