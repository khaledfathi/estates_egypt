<?php
declare(strict_types=1);

namespace App\Features\Owners\Presentation\API\Presenters;

use App\Features\Owners\Application\Outputs\ShowOwnersPaginateOutput;
use App\Shared\Domain\Entities\Owner\OwnerEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use Closure;

final class ShowOwnersPaginatePresenter implements ShowOwnersPaginateOutput
{
    
    private Closure $response;
    /**
     * @inheritDoc
     */
    public function onSuccess(EntitiesWithPagination $ownerEntities): void
    {
       $this->response = fn() => response()->json([
            'status_code' => 200,
            'success' => true,
            'mesage' => 'Owners retrieved successfully',
            'data' => [
                'owners' => OwnerEntity::toArrayCollection($ownerEntities->entities),
                'pagination' => $ownerEntities->pagination,
            ]
        ], 200); 
    }
    public function onFailure(string $error): void
    {
    }
    public function handle (){
        return ($this->response)();
    }
}
