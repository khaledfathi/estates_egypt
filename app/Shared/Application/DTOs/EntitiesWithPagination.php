<?php
declare (strict_types= 1);
namespace App\Shared\Application\DTOs; 

use App\Shared\Application\DTOs\PaginationDTO;

/**
 * @template T 
 */
class EntitiesWithPagination{
    /**
     * 
     * @param PaginationDTO $pagination
     * @param array<T> $entities
     */
    public function __construct(
        public PaginationDTO $pagination,
        public array $entities
    ) {}
}