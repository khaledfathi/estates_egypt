<?php
declare (strict_types=1);
namespace App\Shared\Domain\Repositories;

use App\Shared\Domain\Entities\Estate\EstateUtilityServiceInvoiceEntity;


interface  EstateUtilityServiceInvoiceRepository{
    /**
     * @return array<EstateUtilityServiceInvoiceEntity>
     */
    public function index():array;
    public function show(int  $invoiceId):?EstateUtilityServiceInvoiceEntity;
    public function store(EstateUtilityServiceInvoiceEntity $estateUtilityServiceInvoiceEntity):EstateUtilityServiceInvoiceEntity;
    public function update(EstateUtilityServiceInvoiceEntity $estateUtilityServiceInvoiceEntity):bool;
    public function destroy(int $invoiceId):bool;

}