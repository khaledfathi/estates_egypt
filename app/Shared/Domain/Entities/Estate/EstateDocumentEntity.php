<?php
declare (strict_types= 1);

namespace App\Shared\Domain\Entities\Estate; 

final class EstateDocumentEntity {
    public function __construct(
    public ?int $id = null,
    public ?int $estateId = null,
    public ?string $title = null,
    public ?string $description = null,
    public ?string $file = null,
    ){}

}