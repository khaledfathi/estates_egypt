<?php

declare(strict_types=1);

namespace App\Features\EstateMaintenanceExpenses\Presentation\Http\Controllers;

use App\Features\EstateMaintenanceExpenses\Application\Contracts\CreateEstateMaintenanceExpensesContract;
use App\Features\EstateMaintenanceExpenses\Application\Contracts\DestroyEstateMaintenanceExpensesContract;
use App\Features\EstateMaintenanceExpenses\Application\Contracts\EditEstateMaintenanceExpensesContract;
use App\Features\EstateMaintenanceExpenses\Application\Contracts\ShowAllEstateMaintenanceExpensesContract;
use App\Features\EstateMaintenanceExpenses\Application\Contracts\ShowEstateMaintenanceExpensesContract;
use App\Features\EstateMaintenanceExpenses\Application\Contracts\StoreEstateMaintenanceExpensesContract;
use App\Features\EstateMaintenanceExpenses\Application\Contracts\UpdateEstateMaintenanceExpensesContract;
use App\Features\EstateMaintenanceExpenses\Presentation\Http\Presenters\CreateEstateMaintenanceExpensesPresenter;
use App\Features\EstateMaintenanceExpenses\Presentation\Http\Presenters\DestroyEstateMaintenanceExpensesPresenter;
use App\Features\EstateMaintenanceExpenses\Presentation\Http\Presenters\EditEstateMaintenanceExpensesPresenter;
use App\Features\EstateMaintenanceExpenses\Presentation\Http\Presenters\ShowAllEstateMaintenanceExpensesPresenter;
use App\Features\EstateMaintenanceExpenses\Presentation\Http\Presenters\ShowEstateMaintenanceExpensesPresenter;
use App\Features\EstateMaintenanceExpenses\Presentation\Http\Presenters\StoreEstateMaintenanceExpensesPresenter;
use App\Features\EstateMaintenanceExpenses\Presentation\Http\Presenters\UpdateEstateMaintenanceExpensesPresenter;
use App\Features\EstateMaintenanceExpenses\Presentation\Http\Requests\StoreEstateMaintenanceExpensesRequest;
use App\Features\EstateMaintenanceExpenses\Presentation\Http\Requests\UpdateEstateMaintenanceExpensesRequest;
use App\Http\Controllers\Controller;
use App\Shared\Domain\Entities\Estate\EstateMaintenanceExpensesEntity;
use App\Shared\Domain\Entities\Transaction\TransactionEntity;
use App\Shared\Domain\Enum\Transaction\TransactionDirection;
use App\Shared\Infrastructure\Utilities\CarbonDateUtility;
use Illuminate\Http\Request;

class EstateMaintenanceExpensesController extends Controller
{
    public function __construct(
        private readonly ShowAllEstateMaintenanceExpensesContract $showAllEstateMaintenanceExpensesUsecase,
        private readonly CreateEstateMaintenanceExpensesContract $createEstateMaintenanceExpensesUsecase,
        private readonly StoreEstateMaintenanceExpensesContract $storeEstateMaintenanceExpensesUsecase,
        private readonly ShowEstateMaintenanceExpensesContract $showEstateMaintenanceExpensesUsecase,
        private readonly EditEstateMaintenanceExpensesContract $editEstateMaintenanceExpensesUsecase,
        private readonly UpdateEstateMaintenanceExpensesContract $updateEstateMaintenanceExpensesUsecase,
        private readonly DestroyEstateMaintenanceExpensesContract $destroyEstateMaintenanceExpensesUsecase,
    ) {}
    public function index(Request $request)
    {
        $presenter = new ShowAllEstateMaintenanceExpensesPresenter();
        $this->showAllEstateMaintenanceExpensesUsecase->execute((int)$request->estate_id, $presenter);
        return $presenter->handle();
    }
    public function show(string $estateMaintenanceExpenseId)
    {
        $presenter = new ShowEstateMaintenanceExpensesPresenter();
        $this->showEstateMaintenanceExpensesUsecase->execute((int)$estateMaintenanceExpenseId, $presenter);
        return $presenter->handle();
    }
    public function create(Request $request)
    {
        $estateId = (int) $request->estate_id;
        $presenter = new CreateEstateMaintenanceExpensesPresenter($estateId);
        $this->createEstateMaintenanceExpensesUsecase->execute($estateId, $presenter);
        return $presenter->handle();
    }
    public function store(StoreEstateMaintenanceExpensesRequest $request)
    {
        //prepeare data  
        $entity = $this->formToEstateMaintenanceExpensesEnitity([...$request->all()]);
        //action
        $presenter = new StoreEstateMaintenanceExpensesPresenter();
        $this->storeEstateMaintenanceExpensesUsecase->execute($entity, $presenter);
        return $presenter->handle();
    }
    public function edit(string $estateMaintenanceExpenseId)
    {
        $presenter = new EditEstateMaintenanceExpensesPresenter();
        $this->editEstateMaintenanceExpensesUsecase->execute((int) $estateMaintenanceExpenseId, $presenter);
        return $presenter->handle();
    }
    public function update(UpdateEstateMaintenanceExpensesRequest $request)
    {
        //prepeare data  
        $entity = $this->formToEstateMaintenanceExpensesEnitity([...$request->all(), 'estate_maintenance_expenses_id' => (int) $request->route('estates_maintenance_expense')]);
        //action
        $presenter = new UpdateEstateMaintenanceExpensesPresenter($entity->estateId);
        $this->updateEstateMaintenanceExpensesUsecase->execute($entity, $presenter);
        return $presenter->handle();
    }
    public function destroy(Request $request, string $estateMaintenanceExpenseId)
    {
        $presenter = new DestroyEstateMaintenanceExpensesPresenter((int)$request->estate_id);
        $this->destroyEstateMaintenanceExpensesUsecase->execute((int)$estateMaintenanceExpenseId, $presenter);
        return $presenter->handle();
    }
    private function formToEstateMaintenanceExpensesEnitity(array $formArray): EstateMaintenanceExpensesEntity
    {
        return new EstateMaintenanceExpensesEntity(
            id: $formArray['estate_maintenance_expenses_id'] ?? null,
            estateId: (int) $formArray['estate_id'] ?? null,
            transaction: new TransactionEntity(
                id: isset($formArray['transaction_id']) ? (int)$formArray['transaction_id'] : null,
                date: CarbonDateUtility::from($formArray['date']),
                amount: (int)$formArray['amount'] ?? null,
                direction: TransactionDirection::WITHDRAW,
            ),
            title: $formArray['title'] ?? null,
            description: $formArray['description'] ?? null,
        );
    }
}
