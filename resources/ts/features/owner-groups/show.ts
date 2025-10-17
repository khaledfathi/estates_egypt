
// UI ELEMENTS
const 
    deleteOwnerButton:HTMLElement = document.querySelector("#delete-owner-btn")!,
    deleteOwnerSubmitButton:HTMLElement = document.querySelector("#delete-owner-submit-btn")!,
    deleteOwnershipButtons:NodeListOf<HTMLElement>= document.querySelectorAll(".delete-owner-btn")!;
// ---------------

// CORE
// ---------------

// EVENTS
deleteOwnerButton.addEventListener('click', handleDeleteOwnerButtonClick )
deleteOwnershipButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
        (btn.parentElement?.querySelector( ".delete-submit-btn") as HTMLElement).click();
    });
});
// ---------------

// EVENT HANDLER
function handleDeleteOwnerButtonClick(){
    deleteOwnerSubmitButton.click();
}
// ---------------

// Initialization


export {};
