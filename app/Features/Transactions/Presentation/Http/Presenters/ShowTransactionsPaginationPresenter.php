<?php
declare (strict_types=1);
namespace App\Features\Transactions\Presentation\Http\Presenters;

use App\Features\Transactions\Application\Outputs\ShowTransactionsPaginationOutput;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Log;

final class ShowTransactionsPaginationPresenter implements ShowTransactionsPaginationOutput{
    private Closure $response ; 
    /**
     * @inheritDoc
     */
    public function __construct(
      private readonly ?string $date=null,
    ){
        $this->handleSession();
    }
    private function handleSession()
    {
        $currentPage = request()->fullUrl(); 
        session()->put(SessionKeys::TRANSACTION_CURRENT_INDEX_PAGE, $currentPage);
        session()->put(SessionKeys::TRANSACTION_EDIT_PREVIOUS_PAGE, $currentPage);
    }
    public function onSuccess (EntitiesWithPagination $entitiesWithPagination , int $balance):void{
      $currentDate =Carbon::now()->toDateString();
      $data = [
        'transactions' => $entitiesWithPagination->entities,
        'balance' => $balance,
        'pagination'=> $entitiesWithPagination->pagination,
        'selectedDate' => $this->date ?? $currentDate,
      ];
      $this->response= fn ()=> view('transactions::index' , $data);
    }
    public function onFailure (string $error) :void{
      $this->response = fn()=> view("transactions::index", [
          'error' => Messages::INTERNAL_SERVER_ERROR,
      ]);
      //log
      Log::channel(LogChannels::ERROR)->error(
          'Databse failure',
          ['error' => $error,  'error_source' => __CLASS__ . '::' . __FUNCTION__]
      );
    }
   public function handle(){
      return ($this->response)(); 
   }
}