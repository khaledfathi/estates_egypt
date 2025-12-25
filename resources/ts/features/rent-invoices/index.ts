// UI ELEMENTS
const deleteRentInvoiceButtons= document.querySelectorAll(".delete-rent-invoice-btn");
// ---------------

// CORE
// ---------------

// EVENTS
deleteRentInvoiceButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
        (btn.parentElement?.querySelector( ".delete-submit-btn") as HTMLElement).click();
    });
});
// ---------------

// EVENT HANDLER
// ---------------

// Initialization
// ---------------

export {};
