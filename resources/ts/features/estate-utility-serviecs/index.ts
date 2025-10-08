// UI ELEMENTS
const deleteUtilityServiceButtons= document.querySelectorAll(".delete-utility-service-btn");
// ---------------

// CORE
// ---------------

// EVENTS
deleteUtilityServiceButtons.forEach((btn) => {
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
