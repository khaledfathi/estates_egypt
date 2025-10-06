<?php
declare(strict_types=1);

namespace App\Features\Owners\Presentation\API\Presenters;

use App\Features\Owners\Application\Outputs\StoreOwnerOutput;
use App\Shared\Domain\Entities\Owner\OwnerEntity;

final class StoreOwnerPresenter implements StoreOwnerOutput
{
    public function onSuccess(OwnerEntity $ownerEntity): void
    {
    }
    public function onFailure(string $error): void
    {
    }
    public function handle (){

    }
}
