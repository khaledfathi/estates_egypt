// UI ELEMENTS
const deleteRenterButtons= document.querySelectorAll(".delete-renter-btn");
// ---------------

// CORE
// ---------------

// EVENTS
deleteRenterButtons.forEach((btn) => {
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
