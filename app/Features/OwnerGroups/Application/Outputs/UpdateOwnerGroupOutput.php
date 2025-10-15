<?php
declare(strict_types=1);
namespace App\Features\OwnerGroups\Application\Outputs;

use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;

interface UpdateOwnerGroupOutput {
    public function onSuccess (bool $status):void ;
    public function onFailure (string $error):void ;
}