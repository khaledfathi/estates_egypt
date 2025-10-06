<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Presentation\Http\Presenters;

use App\Features\EstateDocuments\Application\Outputs\ShowEstateDocumentsPaginateOutput;
use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class ShowEstateDocumentsPaginatePresenter implements ShowEstateDocumentsPaginateOutput
{
    private Closure $response;
    public function __construct()
    {
        $this->handleSession();
    }
    private function handleSession()
    {
        $currentPage = url()->current() . '?page=' . request('page');
        session()->put(SessionKeys::ESTATE_DOCUMENT_CURRENT_INDEX_PAGE, $currentPage);
        session()->put(SessionKeys::ESTATE_DOCUMENT_EDIT_PREVIOUS_PAGE, $currentPage);
    }
    public function onSuccess(EntitiesWithPagination $estateDocumentsEntitiesWithPagination, EstateEntity $estateEntity): void
    {
        $data = [
            'estateDocuments' => $estateDocumentsEntitiesWithPagination->entities,
            'estate' => $estateEntity,
            'pagination' => $estateDocumentsEntitiesWithPagination->pagination,
        ];
        //handle session & response
        $pageCounts = $estateDocumentsEntitiesWithPagination->pagination->getPageCounts();
        $requestPageNumber = request('page');
        if ($requestPageNumber > $pageCounts) {
            // if last page empty or user try to add page string query manually
            session()->put(SessionKeys::ESTATE_DOCUMENT_CURRENT_INDEX_PAGE, url()->current() . '?page=' . $pageCounts);
            $this->response = fn() => redirect(route('estates.documents.index' , $estateEntity->id) . '?page=' . $pageCounts);
        } else {
            // notmal use
            $this->response = fn() => view('estates.documents::index', $data);
        }
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() => view('owners::index', [
            'error' => Messages::INTERNAL_SERVER_ERROR,
        ]);
        //log
        Log::channel(LogChannels::ERROR)->error('Databse failure', ['error' => $error, 'error_source' => __CLASS__ . '::' . __FUNCTION__]);
    }
    public function onEstateNotFound(): void
    {
        $this->response = fn() => view('estates.documents::index', ['error' => Messages::DATA_NOT_FOUND]);
    }
    public function handle()
    {
        return ($this->response)();
    }
}
