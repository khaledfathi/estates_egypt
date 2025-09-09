
// UI ELEMENTS
const 
    deleteOwnerButton:HTMLElement = document.querySelector("#delete-owner-btn")!,
    delteOwnerSubmitButton:HTMLElement = document.querySelector("#delete-owner-submit-btn")!;
// ---------------

// CORE
// ---------------

// EVENTS
deleteOwnerButton.addEventListener('click', handleDeleteOwnerButtonClick )
// ---------------

// EVENT HANDLER
function handleDeleteOwnerButtonClick(){
    delteOwnerSubmitButton.click();
}
// ---------------

// Initialization


export {};