
// UI ELEMENTS
const 
    deleteRenterButton:HTMLElement = document.querySelector("#delete-renter-btn")!,
    deleteRenterSubmitButton:HTMLElement = document.querySelector("#delete-renter-submit-btn")!;
// ---------------

// CORE
// ---------------

// EVENTS
deleteRenterButton.addEventListener('click', handleDeleteRenterButtonClick)
// ---------------

// EVENT HANDLER
function handleDeleteRenterButtonClick(){
    deleteRenterSubmitButton.click();
}
// ---------------

// Initialization


export {};