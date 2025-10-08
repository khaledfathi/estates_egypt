
// UI ELEMENTS
const 
    deleteUtilityServiceButton:HTMLElement = document.querySelector("#delete-utility-service-btn")!,
    deleteUtilityServiceSubmitButton:HTMLElement = document.querySelector("#delete-utility-service-submit-btn")!;
// ---------------

// CORE
// ---------------

// EVENTS
deleteUtilityServiceButton.addEventListener('click', handleDeleteOwnerButtonClick )
// ---------------

// EVENT HANDLER
function handleDeleteOwnerButtonClick(){
    deleteUtilityServiceSubmitButton.click();
}
// ---------------

// Initialization


export {};