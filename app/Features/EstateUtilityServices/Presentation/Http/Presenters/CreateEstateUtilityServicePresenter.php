<?php
declare(strict_types=1);
namespace App\Features\EstateUtilityServices\Presentation\Http\Presenters;

use App\Features\EstateUtilityServices\Application\Outputs\CreateEstateUtilityServiceOutput;
use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class CreateEstateUtilityServicePresenter implements CreateEstateUtilityServiceOutput
{
    public Closure $response;
    public function onSuccess(EstateEntity $estateEntity, array $utilityServiceTypes)
    {
        $data  = [
            'estate' => $estateEntity,
            'utilityServiceTypes' => $utilityServiceTypes,
        ];
        $this->response = fn() => view('estates.utility-services::create', $data);
    }
    public function onEstateNotFound(){
        $this->response = fn()=>view("estates.utility-services::create", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(string $error)
    {
        $this->response = fn() => view('estates.utility-services::index', [
            'error' => Messages::INTERNAL_SERVER_ERROR,
        ]);
        //log
        Log::channel(LogChannels::ERROR)
            ->error('Databse failure', ['error' => $error, 'error_source' => __CLASS__ . '::' . __FUNCTION__]);
    }
    public function handle()
    {
        return ($this->response)();
    }
}
