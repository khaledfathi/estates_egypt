<?php
declare(strict_types=1);

namespace App\Features\Owners\Presentation\API\Presenters;

use App\Features\Owners\Application\Outputs\EditOwnerOutput;
use App\Shared\Domain\Entities\Owner\OwnerEntity;

final class EditOwnerPresenter implements EditOwnerOutput
{
    public function onSuccess (OwnerEntity $ownerEntity , array $ownerGroupEnitites):void
    {
    }
    public function onFailure(string $error): void
    {
    }
    public function onNotFound(): void
    {
    }
    public function handle()
    {
    }
}
