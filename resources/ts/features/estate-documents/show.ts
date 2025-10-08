
// UI ELEMENTS
const 
    deleteEstateDocumentButton:HTMLElement = document.querySelector("#delete-estate-document-btn")!,
    deleteSubmitButton:HTMLElement = document.querySelector("#delete-submit-btn")!;
// ---------------

// CORE
// ---------------

// EVENTS
deleteEstateDocumentButton.addEventListener('click', handleDeleteOwnerButtonClick )
// ---------------

// EVENT HANDLER
function handleDeleteOwnerButtonClick(){
    deleteSubmitButton.click();
}
// ---------------

// Initialization


export {};