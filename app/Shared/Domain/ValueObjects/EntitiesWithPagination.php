<?php
declare (strict_types= 1);
namespace App\Shared\Domain\ValueObjects; 


/**
 * @template T 
 */
class EntitiesWithPagination{
    /**
     * 
     * @param ?pagination $pagination
     * @param ?array<T> $entities
     */
    public function __construct(
        public ?Pagination $pagination = null,
        public ?array $entities = null
    ) {}
}