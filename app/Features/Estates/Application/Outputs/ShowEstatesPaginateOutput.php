<?php
declare (strict_types= 1);
namespace  App\Features\Estates\Application\Outputs;

use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

interface ShowEstatesPaginateOutput {

    public function onSucces(EntitiesWithPagination $estateEntities): void;

    public function onFailure(string $error):void;
} 