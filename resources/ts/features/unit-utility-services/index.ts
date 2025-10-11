// UI ELEMENTS
const deleteEstateDocumentButtons= document.querySelectorAll(".delete-estate-document-btn");
// ---------------

// CORE
// ---------------

// EVENTS
deleteEstateDocumentButtons.forEach((btn) => {
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
