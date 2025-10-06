<?php
declare(strict_types=1);

namespace App\Features\EstateDocuments\Application\Outputs;

use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\Entities\EstateDocument\EstateDocumentEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

interface ShowEstateDocumentsPaginateOutput {
    /**
     * of onSuccess
     * @param EntitiesWithPagination<EstateDocumentEntity> $unitEntitiesWithPagination
     * @return void
     */
    public function onSuccess (EntitiesWithPagination $estateDocumentsEntitiesWithPagination , EstateEntity $estateEntity):void ;
    public function onFailure (string $error):void ;
    public function onEstateNotFound ():void ;

}