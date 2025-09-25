<?php
declare (strict_types= 1);

namespace App\Features\Units\Application\Ouputs;

use App\Features\Units\Application\DTOs\UnitFormDTO;

interface CreateUnitOutput{
    public function onSuccess (UnitFormDTO $unitFormData);
    public function onFailure (string $error);
}