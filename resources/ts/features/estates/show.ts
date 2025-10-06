
// UI ELEMENTS
const 
    deleteEstateButton:HTMLElement = document.querySelector("#delete-estate-btn")!,
    deleteEstateSubmitButton:HTMLElement = document.querySelector("#delete-estate-submit-btn")!;
// ---------------

// CORE
// ---------------

// EVENTS
deleteEstateButton.addEventListener('click', handleDeleteOwnerButtonClick )
// ---------------

// EVENT HANDLER
function handleDeleteOwnerButtonClick(){
    deleteEstateSubmitButton.click();
}
// ---------------

// Initialization


export {};