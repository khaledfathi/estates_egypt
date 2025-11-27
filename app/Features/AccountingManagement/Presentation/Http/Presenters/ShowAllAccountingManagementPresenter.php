<?php

declare(strict_types=1);

namespace App\Features\AccountingManagement\Presentation\Http\Presenters; 

use App\Features\AccountingManagement\Application\Outputs\ShowAllAccountingManagementOutput;
use Closure;

final class ShowAllAccountingManagementPresenter implements ShowAllAccountingManagementOutput 
{
    private Closure $response;
    /**
     * @inheritdoc
     */
    public function onSuccess(array $estateEntities): void
    {
        $this->response = fn() => view('accounting-management::index', [
            'estates' => $estateEntities
        ]);
    }
    public function onFailure(string $error): void
    {
        dd('error', $error);
    }

    public function handle()
    {
        return ($this->response)();
    }
}
