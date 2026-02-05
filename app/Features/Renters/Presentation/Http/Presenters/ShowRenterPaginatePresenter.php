<?php

declare(strict_types=1);

namespace App\Features\Renters\Presentation\Http\Presenters;

use App\Features\Renters\Application\Outputs\ShowRentersPaginationOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use Closure;
use Illuminate\Support\Facades\Log;

final class ShowRenterPaginatePresenter implements ShowRentersPaginationOutput
{

    private Closure $response;
    public function __construct()
    {
        $this->handleSession();
    }
    private function handleSession()
    {
        $currentPage = request()->fullUrl(); 
        session()->put(SessionKeys::RENTER_CURRENT_INDEX_PAGE, $currentPage);
        session()->put(SessionKeys::RENTER_EDIT_PREVIOUS_PAGE, $currentPage);
    }
    public function onSuccess(EntitiesWithPagination $renterEntities): void
    {

        $data = [
            'renters' => $renterEntities->entities,
            'pagination' => $renterEntities->pagination,
        ];

        //handle session & response
        $pageCounts = $renterEntities->pagination->getPageCounts();
        $requestPageNumber = request('page');
        if ($requestPageNumber > $pageCounts) {
            // if last page empty or user try to add page string query manually
            session()->put(SessionKeys::RENTER_CURRENT_INDEX_PAGE, url()->current() . '?page=' . $pageCounts);
            $this->response = fn() => redirect(route('renters.index') . '?page=' . $pageCounts);
        } else {
            // notmal use
            $this->response = fn() => view('renters::index', $data);
        }
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() => view('renters::index', [
            'error' => Messages::INTERNAL_SERVER_ERROR,
        ]);
        //log
        Log::channel(LogChannels::ERROR)->error('Databse failure', ['error' => $error, 'error_source' => __CLASS__ . '::' . __FUNCTION__]);
    }
    public function handel()
    {
        return ($this->response)();
    }
}
