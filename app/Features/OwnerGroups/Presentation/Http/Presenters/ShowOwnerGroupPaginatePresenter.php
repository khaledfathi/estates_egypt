<?php

declare(strict_types=1);

namespace App\Features\OwnerGroups\Presentation\Http\Presenters;

use App\Features\OwnerGroups\Application\Outputs\ShowOwnerGroupsPaginationOutput;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class ShowOwnerGroupPaginatePresenter implements ShowOwnerGroupsPaginationOutput
{
    private Closure $response;

    public function __construct()
    {
        $this->handleSession();
    }
    private function handleSession()
    {
        $currentPage = url()->current() . '?page=' . request('page');
        session()->put(SessionKeys::OWNER_GROUP_CURRENT_INDEX_PAGE, $currentPage);
        session()->put(SessionKeys::OWNER_GROUP_EDIT_PREVIOUS_PAGE, $currentPage);
    }
    public function onSuccess(EntitiesWithPagination $ownerGroupsEntitiesWithPagination)
    {
        $data = [
            'ownerGroups' => $ownerGroupsEntitiesWithPagination->entities,
            'pagination' => $ownerGroupsEntitiesWithPagination->pagination,
        ];
        $this->response = fn() => view('owner-groups::index', $data);
    }
    public function onFailure(string $error)
    {
        $this->response = fn() => view('owner-groups::index', [
            'error' => Messages::INTERNAL_SERVER_ERROR,
        ]);
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
