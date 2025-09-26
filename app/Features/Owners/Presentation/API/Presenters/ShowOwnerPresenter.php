<?php

declare(strict_types=1);

namespace App\Features\Owners\Presentation\API\Presenters;

use App\Features\Owners\Application\Outputs\ShowOwnerOutput;
use App\Shared\Domain\Entities\Owner\OwnerEntity;
use Closure;

final class ShowOwnerPresenter implements ShowOwnerOutput
{
    private Closure $response;
    public function onSuccess(OwnerEntity $ownerEntity): void
    {
        $statusCode= 200;
        $this->response = fn() => response()->json([
            'status_code' => $statusCode,
            'success' => true,
            'mesage' => 'Owner retrieved successfully',
            'data' => $ownerEntity->toArray() 
        ], $statusCode);
    }
    public function onNotFound(): void {
        $statusCode= 404;
        $this->response = fn() => response()->json([
            'status_code' => $statusCode,
            'success' => false,
            'message' => 'Owner not found'
        ], $statusCode);
    }
    public function onFailure(String $error): void {
        $statusCode= 500;
        $this->response = fn() => response()->json([
            'status_code' => $statusCode,
            'success' => false,
            'message' => 'internal server error' ,
        ], $statusCode);
    }

    public function handle()
    {
        return ($this->response)();
    }
}
