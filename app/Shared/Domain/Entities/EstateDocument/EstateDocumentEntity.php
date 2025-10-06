<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entities\EstateDocument;

use App\Shared\Domain\Entities\Estate\EstateEntity;

final class EstateDocumentEntity
{
    public function __construct(
        public ?int $id = null,
        public ?int $estateId = null,
        public ?string $title = null,
        public ?string $description = null,
        public ?string $file = null,
        public ?EstateEntity $estate = null,
    ) {}

    public  function isImage(): bool
    {
        return    in_array(
            pathinfo($this->file, PATHINFO_EXTENSION),
            ['jpg', 'jpeg', 'png', 'avif'] // The correct list of extensions
        );
    }
    public function isPdf():bool
    {
        return  pathinfo($this->file, PATHINFO_EXTENSION) == 'pdf';
    }
}
