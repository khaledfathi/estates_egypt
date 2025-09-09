<?php
declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects; 

final readonly class Pagination 
{
    public function __construct(
        public ?int $perPage  = null,
        public ?int $currentPage = null,
        public ?string $path = null,
        public ?string $pageName = null,
        public ?int  $total = null,
    ) {}

    private function generatePageURL(int $pageQueryNumber):mixed 
    {
        return "$this->path?$this->pageName=$pageQueryNumber";
    }
    public function getPageCounts(): int
    {
        return (int) ceil($this->total / $this->perPage);
    }
    public function getLinks(): array
    {
        $linksArray = [];
        for ($i = 0; $i < $this->getPageCounts(); $i++) {
            $linksArray[] = $this->generatePageURL($i+1);
        }
        return $linksArray;
    }
    public function getCurrentPageURL(): string
    {
        return $this->generatePageURL($this->currentPage); }
    public function getNextPageURL(): ?string
    {
        $pageCounts = $this->getPageCounts();
        $pageNumber = $this->currentPage < $pageCounts ? $this->currentPage + 1 : $pageCounts;
        return $this->generatePageURL($pageNumber);
    }
    public function getPreviousPageURL(): ?string
    {
        $pageNumber = $this->currentPage > 1 ? $this->currentPage - 1 : $this->currentPage ;
        return $this->generatePageURL($pageNumber);
    }
}