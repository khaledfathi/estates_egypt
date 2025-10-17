<?php
declare(strict_types=1);

namespace App\Features\Units\Application\Usecases;

use App\Features\Units\Application\Contracts\ShowUnitContract;
use App\Features\Units\Application\Ouputs\ShowUnitOutput;
use App\Shared\Domain\Repositories\UnitRepository;

final class ShowUnitUsecase implements ShowUnitContract
{
    public function __construct(
        private readonly UnitRepository $unitRepository,
    ) {}
    public function execute(int $unitId, ShowUnitOutput $presenter): void {
        try{
            $unitRecord = $this->unitRepository->show($unitId); 
            $unitRecord 
                ?  $presenter->onSuccess( $unitRecord)
                : $presenter->onNotFount();
        }catch (\Exception $e){
            $presenter->onFailure($e->getMessage());
        }
    }
}
