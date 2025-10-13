<?php

declare(strict_types=1);

namespace App\Features\Estates\Presentation\Http\Presenters;

use App\Features\Estates\Application\Outputs\ShowEstatesPaginateOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use Closure;
use Illuminate\Support\Facades\Log;

final class ShowEstaetsPaginatePresenter implements ShowEstatesPaginateOutput
{

    public Closure $response;
    public function onSucces(EntitiesWithPagination $estateEntities): void
    {
        $data = [
            'estates' => $estateEntities->entities,
            'pagination' => $estateEntities->pagination,
        ];
        $this->response = fn() => view('estates::index',$data);
    }

    public function onFailure(string $error): void
    {
        $this->response = fn ()=> view('estates::index', [
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
