// UI ELEMENTS
const accountManagementForm = document.querySelector( "#account-management-form")!;
const maintenanceExpensesBtn = document.querySelector( "#maintenance-expenses-btn")!;
const rentsPaymentBtn = document.querySelector( "#rents-payment-btn")!;
const estateUtilityServicesInvoicesBtn = document.querySelector( "#estate-utilitiy-services-invoices-btn")!;

/**
 * maintenance-expenses-btn
 * rents-payment-btn
 * estate-utilitiy-services-invoices-btn
 */
console.log(accountManagementForm);
// ---------------

// CORE
// ---------------

// EVENTS
maintenanceExpensesBtn.addEventListener( "click", ()=> setFormAction( maintenanceExpensesBtn.getAttribute('data-form-action')!));
rentsPaymentBtn.addEventListener( "click", ()=> setFormAction( rentsPaymentBtn.getAttribute('data-form-action')!));
estateUtilityServicesInvoicesBtn.addEventListener( "click", ()=> setFormAction( estateUtilityServicesInvoicesBtn.getAttribute('data-form-action')!));
// ---------------

// EVENT HANDLER
function setFormAction(url: string) {
    accountManagementForm.setAttribute("action", url);
}
// ---------------

// Initialization
// ---------------

export {};
