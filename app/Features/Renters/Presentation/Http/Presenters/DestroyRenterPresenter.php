<?php

declare(strict_types=1);

namespace App\Features\Renters\Presentation\Http\Presenters;

use App\Features\Renters\Application\Outputs\DestroyRenterOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class  DestroyRenterPresenter  implements DestroyRenterOutput
{

  private Closure $response;
  private $lastIndexPage;  
  public function __construct()
  {
    $this->lastIndexPage = session(SessionKeys::RENTER_CURRENT_INDEX_PAGE) ?? url()->previous();
  }
  public function onSuccess(bool $status): void
  {

    $this->response = fn () =>
      redirect($this->lastIndexPage)->with('success', Messages::DESTROY_SUCCESS);
  }
  public function onFailure(string $error): void
  {
    $this->response = fn() => back()->with('error', Messages::INTERNAL_SERVER_ERROR);
    //log
    Log::channel(LogChannels::ERROR)
      ->error('Databse failure', ['error' => $error, 'error_source' => __CLASS__ . '::' . __FUNCTION__]);
  }
  public function handle()
  {
    return ($this->response)();
  }
}
