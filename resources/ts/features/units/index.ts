// UI ELEMENTS
const deleteEstateButtons= document.querySelectorAll(".delete-unit-btn");
// ---------------

// CORE
// ---------------

// EVENTS
deleteEstateButtons.forEach((btn) => {
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
