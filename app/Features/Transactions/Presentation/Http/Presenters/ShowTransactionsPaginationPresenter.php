<?php
declare (strict_types=1);
namespace App\Features\Transactions\Presentation\Http\Presenters;

use App\Features\Transactions\Application\Outputs\ShowTransactionsPaginationOutput;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use Carbon\Carbon;
use Closure;

final class ShowTransactionsPaginationPresenter implements ShowTransactionsPaginationOutput{
    private Closure $reponse ; 
    /**
     * @inheritDoc
     */
    public function onSuccess (EntitiesWithPagination $entitiesWithPagination):void{
      $data = [
        'transactions' => $entitiesWithPagination->entities,
        'pagination'=> $entitiesWithPagination->pagination,
        'currentDate' => Carbon::now()->toDateString(),
      ];
      $this->reponse = fn ()=> view('transactions::index' , $data);
    }
    public function onFailure (string $error) :void{
      dd('success');
    }
   public function handle(){
      return ($this->reponse)(); 
   }
}