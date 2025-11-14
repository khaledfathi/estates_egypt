// UI ELEMENTS
const deleteTransactionButtons= document.querySelectorAll(".delete-transaction-btn");
// ---------------

// CORE
// ---------------

// EVENTS
deleteTransactionButtons.forEach((btn) => {
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
