<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// ########## OWNERS ########## 
// owners
Breadcrumbs::for('owners', function (BreadcrumbTrail $trail) {
    $trail->push('الملاك', route('owners.index'));
});
// owners > show  > [ownerId]
Breadcrumbs::for('owners.show', function (BreadcrumbTrail $trail, $ownerId) {
    $trail->parent('owners');
    $trail->push('المالك', route('owners.show', $ownerId));
});
// owners > create   
Breadcrumbs::for('owners.create', function (BreadcrumbTrail $trail) {
    $trail->parent('owners');
    $trail->push('اضافة', route('owners.create'));
});
// owners > edit  > [ownerId]
Breadcrumbs::for('owners.edit', function (BreadcrumbTrail $trail, $ownerId) {
    $trail->parent('owners.show', $ownerId);
    $trail->push('تحديث', route('owners.edit', $ownerId));
});
// ########################################### 

// ########## OWNERS GROUPS ########## 
// owner-groups  
Breadcrumbs::for('owner-groups', function (BreadcrumbTrail $trail) {
    $trail->parent('owners');
    $trail->push('مجموعات', route('owner-groups.index'));
});
// owner-groups > show  > [owenrGroupId]
Breadcrumbs::for('owner-groups.show', function (BreadcrumbTrail $trail, $ownerGroupId) {
    $trail->parent('owner-groups');
    $trail->push('مجموعة', route('owner-groups.show', $ownerGroupId));
});
// owner-groups > create  
Breadcrumbs::for('owner-groups.create', function (BreadcrumbTrail $trail) {
    $trail->parent('owner-groups');
    $trail->push('اضافة', route('owner-groups.create'));
});
// owner-groups > edit  > [ownerGroupId]
Breadcrumbs::for('owner-groups.edit', function (BreadcrumbTrail $trail, $ownerGroupId) {
    $trail->parent('owner-groups.show', $ownerGroupId);
    $trail->push('تحديث', route('owner-groups.edit', $ownerGroupId));
});
// ########################################### 

// ########## RENTERS ########## 
// renters > 
Breadcrumbs::for('renters', function (BreadcrumbTrail $trail) {
    $trail->push('المستأجرين', route('renters.index'));
});
// renters > show > [id]
Breadcrumbs::for('renters.show', function (BreadcrumbTrail $trail, $renterId) {
    $trail->parent('renters');
    $trail->push('المستأجر', route('renters.show', $renterId));
});
// renters > create > [id]
Breadcrumbs::for('renters.create', function (BreadcrumbTrail $trail) {
    $trail->parent('renters');
    $trail->push('اضافة', route('renters.create'));
});
// renters > edit > [id]
Breadcrumbs::for('renters.edit', function (BreadcrumbTrail $trail, $renterId) {
    $trail->parent('renters.show', $renterId);
    $trail->push('تحديث', route('renters.edit', $renterId));
});
// ########################################### 

// ########## ESTATES ########## 
// estates
Breadcrumbs::for('estates', function (BreadcrumbTrail $trail) {
    $trail->push('العقارات', route('estates.index'));
});
// estates > show  > [estateId]
Breadcrumbs::for('estates.show', function (BreadcrumbTrail $trail, $estateId) {
    $trail->parent('estates');
    $trail->push('العقار', route('estates.show', $estateId));
});
// estates > create 
Breadcrumbs::for('estates.create', function (BreadcrumbTrail $trail) {
    $trail->parent('estates');
    $trail->push('اضافة', route('estates.create'));
});
// estates > edit  > [estateId]
Breadcrumbs::for('estates.edit', function (BreadcrumbTrail $trail, $estateId) {
    $trail->parent('estates');
    $trail->push('تحديث', route('estates.edit'));
});
// ########################################### 

// ########## UNITS ########## 
// estates > units > [estateId]
Breadcrumbs::for('estates.units', function (BreadcrumbTrail $trail, $estateId) {
    $trail->parent('estates.show', $estateId);
    $trail->push('الوحدات', route('estates.units.index', $estateId));
});
// estates > units > show  > [estateId , $unitId]
Breadcrumbs::for('estates.units.show', function (BreadcrumbTrail $trail, $estateId, $unitId) {
    $trail->parent('estates.units', $estateId);
    $trail->push('الوحدة', route('estates.units.show', [$estateId, $unitId]));
});
// estates > units > create > [estateId]
Breadcrumbs::for('estates.units.create', function (BreadcrumbTrail $trail, $estateId) {
    $trail->parent('estates.units', $estateId);
    $trail->push('اضافة', route('estates.units.create', $estateId));
});
// estates > units > edit  > [estateId , $unitId]
Breadcrumbs::for('estates.units.edit', function (BreadcrumbTrail $trail, $estateId, $unitId) {
    $trail->parent('estates.units', $estateId);
    $trail->push('تحديث', route('estates.units.edit', [$estateId, $unitId]));
});

// ########## UNITS UTILITY SERVICES ########## 
// estates > units > utility-services > [estateId , unitId] 
Breadcrumbs::for('estates.units.utility-services', function (BreadcrumbTrail $trail, $estateId, $unitId) {
    $trail->parent('estates.units.show', $estateId, $unitId);
    $trail->push('المرافق', route('estates.units.utility-services.index', [$estateId, $unitId]));
});
// estates > units > utility-services > contracts > show  > [estateId , $unitId , $utilityServiceId]
Breadcrumbs::for('estates.units.utility-services.show', function (BreadcrumbTrail $trail, $estateId, $unitId, $utilityServiceId) {
    $trail->parent('estates.units.utility-services', $estateId, $unitId);
    $trail->push('المرفق', route('estates.units.utility-services.show', [$estateId, $unitId, $utilityServiceId]));
});
// estates > units > utility-services > contracts > create  > [estateId , $unitId]
Breadcrumbs::for('estates.units.utility-services.create', function (BreadcrumbTrail $trail, $estateId, $unitId) {
    $trail->parent('estates.units.utility-services', $estateId, $unitId);
    $trail->push('اضافة', route('estates.units.utility-services.create', [$estateId, $unitId]));
});
// estates > units > utility-services > contracts > edit  >  [estateId , $unitId ,$utilityServiceId]
Breadcrumbs::for('estates.units.utility-services.edit', function (BreadcrumbTrail $trail, $estateId, $unitId, $utilityServiceId) {
    $trail->parent('estates.units.utility-services.show', $estateId, $unitId, $utilityServiceId);
    $trail->push('تحديث', route('estates.units.utility-services.edit', [$estateId, $unitId, $utilityServiceId]));
});
// ########################################### 

// ########## UNITS OWNERSHIPS ########## 
// estates > units > ownerships > create > [estateId , $unitId] 
Breadcrumbs::for('estates.units.ownerships.create', function (BreadcrumbTrail $trail, $estateId, $unitId) {
    $trail->parent('estates.units.show', $estateId, $unitId);
    $trail->push('تسجيل مالك/ملاك', route('estates.units.ownerships.create', [$estateId, $unitId]));
});
// ########################################### 


// ########## UNITS CONTRACTS ########## 
// estates > units > contracts > [estateId , $unitId ]
Breadcrumbs::for('estates.units.contracts', function (BreadcrumbTrail $trail, $estateId, $unitId) {
    $trail->parent('estates.units.show', $estateId, $unitId);
    $trail->push('التعاقدات', route('estates.units.contracts.index', [$estateId, $unitId]));
});
// estates > units > contracts > show  > [estateId, $unitId , $contractId]
Breadcrumbs::for('estates.units.contracts.show', function (BreadcrumbTrail $trail, $estateId, $unitId, $contractId) {
    $trail->parent('estates.units.contracts', $estateId, $unitId);
    $trail->push('تعاقد', route('estates.units.contracts.show', [$estateId, $unitId, $contractId]));
});
// estates > units > contracts > create  > [estateId , unitId]
Breadcrumbs::for('estates.units.contracts.create', function (BreadcrumbTrail $trail, $estateId, $unitId) {
    $trail->parent('estates.units.contracts', $estateId, $unitId);
    $trail->push('اضافة', route('estates.units.contracts.create', [$estateId, $unitId]));
});
// estates > units > contracts > edit  > [estateId , unitId , contractId]
Breadcrumbs::for('estates.units.contracts.edit', function (BreadcrumbTrail $trail, $estateId, $unitId, $contractId) {
    $trail->parent('estates.units.contracts.show', $estateId, $unitId, $contractId);
    $trail->push('تحديث', route('estates.units.contracts.edit', [$estateId, $unitId, $contractId]));
});
// ########################################### 

// ########## ESTATE DOCUMENTS ########## 
// estates > documents > [estateId] 
Breadcrumbs::for('estates.documents', function (BreadcrumbTrail $trail, $estateId) {
    $trail->parent('estates.show', $estateId,);
    $trail->push('مستندات', route('estates.documents.index', [$estateId]));
});
// estates > documents > show  > [estateId , documentId]
Breadcrumbs::for('estates.documents.show', function (BreadcrumbTrail $trail, $estateId, $documentId) {
    $trail->parent('estates.documents', $estateId);
    $trail->push('المستند', route('estates.documents.show', [$estateId, $documentId]));
});
// estates > documents > create  > [estateId]
Breadcrumbs::for('estates.documents.create', function (BreadcrumbTrail $trail, $estateId) {
    $trail->parent('estates.documents', $estateId,);
    $trail->push('اضافة', route('estates.documents.create', [$estateId]));
});
// estates > documents > edit  > [estateId , $documentId]
Breadcrumbs::for('estates.documents.edit', function (BreadcrumbTrail $trail, $estateId, $documentId) {
    $trail->parent('estates.documents.show', $estateId, $documentId);
    $trail->push('تحديث', route('estates.documents.edit', [$estateId, $documentId]));
});
// ########################################### 

// ########## ESTSTATE UTILITY SERVICES ########## 
// estates > utility-services [estateID] 
Breadcrumbs::for('estates.utility-services', function (BreadcrumbTrail $trail, $estateId) {
    $trail->parent('estates.show', $estateId);
    $trail->push('المرافق', route('estates.utility-services.index', [$estateId]));
});
// estates > utility-services > show > [estateId , $utilityServiceId]
Breadcrumbs::for('estates.utility-services.show', function (BreadcrumbTrail $trail, $estateId, $utilityServiceId) {
    $trail->parent('estates.utility-services', $estateId);
    $trail->push('المرفق', route('estates.utility-services.show', [$estateId, $utilityServiceId]));
});
// estates > utility-services > create > [estateId] 
Breadcrumbs::for('estates.utility-services.create', function (BreadcrumbTrail $trail, $estateId) {
    $trail->parent('estates.utility-services', $estateId);
    $trail->push('اضافة', route('estates.utility-services.create', [$estateId]));
});
// estates > utility-services > edit > [estateId , utilityServiceId ] 
Breadcrumbs::for('estates.utility-services.edit', function (BreadcrumbTrail $trail, $estateId, $utilityServiceId) {
    $trail->parent('estates.utility-services.show', $estateId, $utilityServiceId);
    $trail->push('تحديث', route('estates.utility-services.edit', [$estateId, $utilityServiceId]));
});
// ########################################### 

// ########## UNITS CONTRACTS ########## 
// estates > utility-services > invoices > rent-invoices > create  > [estateId , utilityServiceId]
Breadcrumbs::for('estates.utility-services.invoices.create', function (BreadcrumbTrail $trail, $estateId, $utilityServiceId) {
    $trail->parent('estates.utility-services.show', $estateId, $utilityServiceId);
    $trail->push('تسجيل فاتورة', route('estates.utility-services.invoices.create', [$estateId, $utilityServiceId]));
});
// estates > utility-services > invoices > rent-invoices > edit  > [estateId, utilityServiceId, invoiceId]
Breadcrumbs::for('estates.utility-services.invoices.edit', function (BreadcrumbTrail $trail, $estateId, $utilityServiceId, $invoiceId) {
    $trail->parent('estates.utility-services.show', $estateId, $utilityServiceId);
    $trail->push('تحديث فاتورة', route('estates.utility-services.invoices.edit', [$estateId, $utilityServiceId, $invoiceId]));
});
// ########################################### 

// ########## ESTATE MAINTENANCE EXPENSES ########## 
// estates > maintenance-expenses > [estateId] 
Breadcrumbs::for('estates.maintenance-expenses', function (BreadcrumbTrail $trail, $estateId) {
    $trail->parent('estates.show', $estateId);
    $trail->push('مصروفات الصيانة', route('estates.maintenance-expenses.index', $estateId));
});
// estates > maintenance-expenses > show > [estateId , maintenanceExpenseId]
Breadcrumbs::for('estates.maintenance-expenses.show', function (BreadcrumbTrail $trail, $estateId, $maintenanceExpenseId) {
    $trail->parent('estates.maintenance-expenses', $estateId);
    $trail->push('مصروف صيانة', route('estates.maintenance-expenses.show', [$estateId, $maintenanceExpenseId]));
});
// estates > maintenance-expenses > create > [estateId]
Breadcrumbs::for('estates.maintenance-expenses.create', function (BreadcrumbTrail $trail, $estateId) {
    $trail->parent('estates.maintenance-expenses', $estateId);
    $trail->push('اضافة', route('estates.maintenance-expenses.index', $estateId));
});
// estates > maintenance-expenses > edit > [estateId , maintenanceExpenseId]
Breadcrumbs::for('estates.maintenance-expenses.edit', function (BreadcrumbTrail $trail, $estateId, $maintenanceExpenseId) {
    $trail->parent('estates.maintenance-expenses.show', $estateId, $maintenanceExpenseId);
    $trail->push('تحديث', route('estates.maintenance-expenses.edit', [$estateId, $maintenanceExpenseId]));
});
// ########################################### 


// ########## TRANSACTIONS ########## 
// transactions  
Breadcrumbs::for('transactions', function (BreadcrumbTrail $trail) {
    $trail->push('الخزينة', route('transactions.index'));
});
// transactions > show  > [transactionId]
Breadcrumbs::for('transactions.show', function (BreadcrumbTrail $trail, $transactionId) {
    $trail->parent('transactions');
    $trail->push('معاملة', route('transactions.show', $transactionId));
});
// transactions > create  
Breadcrumbs::for('transactions.create', function (BreadcrumbTrail $trail) {
    $trail->parent('transactions');
    $trail->push('اضافة', route('transactions.create'));
});
// transactions > edit  > [transactionId]
Breadcrumbs::for('transactions.edit', function (BreadcrumbTrail $trail, $transactionId) {
    $trail->parent('transactions.show', $transactionId);
    $trail->push('تحديث', route('transactions.edit', $transactionId));
});
// ########################################### 

// ########## RENT INVOICES ########## 
// estates > units > contracts > rent-invoices > [estateId , $unitId , $contractId]
Breadcrumbs::for('estates.units.contracts.rent-invoices', function (BreadcrumbTrail $trail, $estateId, $unitId, $contractId) {
    $trail->parent('estates.units.contracts.show', $estateId, $unitId, $contractId);
    $trail->push('سجل الايجارات', route('estates.units.contracts.rent-invoices.index', [$estateId, $unitId, $contractId]));
});
// estates > units > contracts > rent-invoices > show  > [estateId , unitId , contractId, rentInvoiceId]
Breadcrumbs::for('estates.units.contracts.rent-invoices.show', function (BreadcrumbTrail $trail, $estateId, $unitId, $contractId , $rentInvoiceId) {
    $trail->parent('estates.units.contracts.rent-invoices', $estateId, $unitId, $contractId);
    $trail->push('ايصال سداد ايجار', route('estates.units.contracts.rent-invoices.show', [$estateId, $unitId, $contractId, $rentInvoiceId]));
});
// estates > units > contracts > rent-invoices > create  > [estateId , unitId , contractId]
Breadcrumbs::for('estates.units.contracts.rent-invoices.create', function (BreadcrumbTrail $trail, $estateId, $unitId, $contractId) {
    $trail->parent('estates.units.contracts.rent-invoices', $estateId, $unitId, $contractId);
    $trail->push('اضافة', route('estates.units.contracts.rent-invoices.create', [$estateId, $unitId, $contractId]));
});
// estates > units > contracts > rent-invoices > edit  > [estateId , unitId , contractId, rentInvoiceId]
Breadcrumbs::for('estates.units.contracts.rent-invoices.edit', function (BreadcrumbTrail $trail, $estateId, $unitId, $contractId , $rentInvoiceId) {
    $trail->parent('estates.units.contracts.rent-invoices', $estateId, $unitId, $contractId);
    $trail->push('تحديث فاتورة سداد ايجار', route('estates.units.contracts.rent-invoices.edit', [$estateId, $unitId, $contractId, $rentInvoiceId]));
});
// ########################################### 

// ########## SHARED WATER INVOICES ########## 
// estates > units > contracts > shared water invoice > [ estateId , $unitId , $contractId ]
Breadcrumbs::for('estates.units.contracts.shared-water-invoices', function (BreadcrumbTrail $trail, $estateId, $unitId, $contractId) {
    $trail->parent('estates.units.contracts.show', $estateId, $unitId, $contractId);
    $trail->push('سجل فواتير المياة المشتركة', route('estates.units.contracts.shared-water-invoices.index', [$estateId, $unitId, $contractId]));
});
// parent > child1 > child2 > show > [param1 , param2]
// parent > child1 > child2 > create > [param1 , param2]
// estates > units > contracts > shared water invoice > [ estateId , unitId , contractId, waterSharedInvoicesId ]
Breadcrumbs::for('estates.units.contracts.shared-water-invoices.edit', function (BreadcrumbTrail $trail, $estateId, $unitId, $contractId, $sharedWaterInvoiceId) {
    $trail->parent('estates.units.contracts.shared-water-invoices', $estateId, $unitId, $contractId);
    $trail->push('تحديث', route('estates.units.contracts.shared-water-invoices.index', [$estateId, $unitId, $contractId, $sharedWaterInvoiceId]));
});
// ########################################### 



// ########## TMPLATE ########## 
// parent > child1 > child2 > [param1 , param2]
// parent > child1 > child2 > show > [param1 , param2]
// parent > child1 > child2 > create > [param1 , param2]
// parent > child1 > child2 > edit > [param1 , param2]
// ########################################### 