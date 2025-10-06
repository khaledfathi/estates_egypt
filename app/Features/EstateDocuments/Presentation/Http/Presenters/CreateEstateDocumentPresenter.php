<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Presentation\Http\Presenters;

use App\Features\EstateDocuments\Application\Outputs\CreateEstateDocumentOutput as OutputsCreateEstateDocumentOutput;
use App\Shared\Domain\Entities\Estate\EstateEntity;
use Closure;

final class CreateEstateDocumentPresenter implements OutputsCreateEstateDocumentOutput
{

    private Closure $resopnse ;
    public function onSuccess(EstateEntity $estateEntity)
    {
        $data = [
            'estate' => $estateEntity
        ];
        $this->resopnse = fn() => view('estates.documents::create', $data);
    }
    public function onNotFound() {
        dd('Estate Not Found');
    }
    public function onFailure(string $error)
    {
        dd('Estate Document Failure');
    }
    public function handle()
    {
        return ($this->resopnse)();
    }
}
