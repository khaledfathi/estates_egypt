// UI ELEMENTS
const deleteContractButton= document.querySelectorAll(".delete-contract-btn");
// ---------------

// CORE
// ---------------

// EVENTS
deleteContractButton.forEach((btn) => {
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
