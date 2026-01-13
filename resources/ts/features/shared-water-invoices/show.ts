
// UI ELEMENTS
const 
    deleteRentInvoiceButton:HTMLElement = document.querySelector("#delete-rent-invoice-btn")!,
    deleteRentInvoiceSubmitButton:HTMLElement = document.querySelector("#delete-rent-invoice-submit-btn")!;
// ---------------

// CORE
// ---------------

// EVENTS
deleteRentInvoiceButton .addEventListener('click', handleDeleteRenterButtonClick)
// ---------------

// EVENT HANDLER
function handleDeleteRenterButtonClick(){
    deleteRentInvoiceSubmitButton.click();
}
// ---------------

// Initialization


export {};