<?php
declare(strict_types=1);

namespace App\Features\Owners\Presentation\Http\Presenters;

use App\Features\Owners\Application\DTOs\OwnerEntitiesWithPagination;
use App\Features\Owners\Application\Outputs\ShowOwnersPaginateOutput;
use App\Shared\Contstants\LogChannels;
use App\Shared\Contstants\Messages;
use App\Shared\Contstants\SessionKeys;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

final class ShowOwnersPaginatePresenter implements ShowOwnersPaginateOutput
{
    private Closure $response;
    public function __construct()
    {
        $this->handleSession();
    }
    private function handleSession()
    {
        $currentPage = url()->current() . '?page=' . request('page');
        session()->put(SessionKeys::OWNER_CURRENT_INDEX_PAGE, $currentPage);
        session()->put(SessionKeys::OWNER_EDIT_PREVIOUS_PAGE, $currentPage);
    }
    public function onSucces(OwnerEntitiesWithPagination $ownerEntities): void
    {
        $data = [
            'owners' => $ownerEntities->entities,
            'pagination' => $ownerEntities->pagination,
        ];
        $pageCounts = $ownerEntities->pagination->getPageCounts();
        $requestPageNumber = request('page');
        if ($requestPageNumber > $pageCounts) {
            // if last page empty or user try to add page string query manually
            session()->put(SessionKeys::OWNER_CURRENT_INDEX_PAGE, url()->current() . '?page=' . $pageCounts);
            $this->response = fn() => redirect(route('owners.index') . '?page=' . $pageCounts);
        } else {
            // notmal use
            $this->response = fn() => view('owners.index', $data);
        }
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() => view('owners.index', [
            'error' => Messages::INTERNAL_SERVER_ERROR,
        ]);
        //log
        Log::channel(LogChannels::ERROR)->error('Databse failure', ['error' => $error, 'error_source' => __CLASS__ . '::' . __FUNCTION__]);
    }
    public function handle(): RedirectResponse|View
    {
        return ($this->response)();
    }
}
