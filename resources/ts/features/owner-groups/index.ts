// UI ELEMENTS
const deleteOwnerButtons= document.querySelectorAll(".delete-owner-btn");
// ---------------

// CORE
// ---------------

// EVENTS
deleteOwnerButtons.forEach((btn) => {
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
