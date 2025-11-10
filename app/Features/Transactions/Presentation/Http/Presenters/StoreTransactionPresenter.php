<?php

declare(strict_types=1);

namespace App\Features\Transactions\Presentation\Http\Presenters;

use App\Features\Transactions\Application\Outputs\StoreTransactionOutput;

final class StoreTransactionPresenter implements StoreTransactionOutput
{
    public function handle()
    {
        return __CLASS__ . "::" . __FUNCTION__;
    }
}
