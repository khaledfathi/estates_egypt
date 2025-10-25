<?php
declare (strict_types=1);
namespace  App\Features\OwnerGroups\Application\Outputs;

interface UnlinkOwnerFromGroupOutput {
    public function onSuccess (bool $status):void;
    public function onFailure(string $error):void;
}