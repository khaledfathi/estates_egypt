<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Presentation\Http\Presenters;

use App\Features\EstateDocuments\Application\Outputs\DownloadEstateDocumentFileOutput;
use Closure;

final  class ViewEstateDocumentFilePresenter implements DownloadEstateDocumentFileOutput
{


    private Closure $response;
    public function onSuccess(string $filePath): void
    {
        $this->response = fn() => response()->file(
            $filePath,
            [
                'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                'Pragma' => 'no-cache',
                'Expires' => 0,
            ]
        );
    }
    public function onFailure(): void
    {
        $this->response = fn() => abort(404);
    }
    public function handle()
    {
        return ($this->response)();
    }
}
