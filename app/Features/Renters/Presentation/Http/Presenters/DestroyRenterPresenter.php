<?php

declare(strict_types=1);

namespace App\Features\Renters\Presentation\Http\Presenters;

use App\Features\Renters\Application\Outputs\DestroyRenterOutput;
use App\Shared\Contstants\LogChannels;
use App\Shared\Contstants\Messages;
use App\Shared\Contstants\SessionKeys;
use Closure;
use Illuminate\Support\Facades\Log;

final class  DestroyRenterPresenter  implements DestroyRenterOutput
{

  private Closure $response;
  public function onSuccess(bool $status): void
  {

    $this->response = function () {
      $url = session(SessionKeys::RENTER_CURRENT_INDEX_PAGE);
      return redirect($url)->with('success', Messages::DESTROY_SUCCESS);
    };
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
