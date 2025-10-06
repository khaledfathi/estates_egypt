<?php

declare(strict_types=1);

namespace App\Features\Units\Presentation\Http\Presenters;

use App\Features\Units\Application\Ouputs\ShowUnitPaginateOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use Closure;
use Illuminate\Support\Facades\Log;

final class ShowUnitsPaginatePresenter implements ShowUnitPaginateOutput
{
    private Closure $response;
    public function __construct()
    {
        $this->handleSession();
    }
    private function handleSession()
    {
        $currentPage = url()->current() . '?page=' . request('page');
        session()->put(SessionKeys::UNIT_CURRENT_INDEX_PAGE, $currentPage);
        session()->put(SessionKeys::UNIT_EDIT_PREVIOUS_PAGE, $currentPage);
    }
    public function onSuccess(EntitiesWithPagination $unitEntitiesWithPagination, EstateEntity $estateEntity): void
    {
        $data = [
            'units' => $unitEntitiesWithPagination->entities,
            'estate' => $estateEntity,
            'pagination' => $unitEntitiesWithPagination->pagination,
        ];
        //handle session & response
        $pageCounts = $unitEntitiesWithPagination->pagination->getPageCounts();
        $requestPageNumber = request('page');
        if ($requestPageNumber > $pageCounts) {
            // if last page empty or user try to add page string query manually
            session()->put(SessionKeys::UNIT_CURRENT_INDEX_PAGE, url()->current() . '?page=' . $pageCounts);
            $this->response = fn() => redirect(route('estates.units.index' , $estateEntity->id) . '?page=' . $pageCounts);
        } else {
            // notmal use
            $this->response = fn() => view('units::index', $data);
        }
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() => view('units::index', [
            'error' => Messages::INTERNAL_SERVER_ERROR,
        ]);
        //log
        Log::channel(LogChannels::ERROR)->error('Databse failure', ['error' => $error, 'error_source' => __CLASS__ . '::' . __FUNCTION__]);
    }

    public function onEstateNotFound(): void
    {
        $this->response = fn() => view('units::index', ['error' => Messages::DATA_NOT_FOUND]);
    }
    public function handle()
    {
        return ($this->response)();
    }
}
