
// UI ELEMENTS
const 
    deleteOwnerButton:HTMLElement = document.querySelector("#delete-owner-btn")!,
    delteOwnerSubmitButton:HTMLElement = document.querySelector("#delete-owner-submit-btn")!,
    deleteOwnershipButtons:NodeListOf<HTMLElement>= document.querySelectorAll("#delete-ownership-btn")!;
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
deleteOwnershipButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
        (btn.parentElement?.querySelector( ".delete-submit-btn") as HTMLElement).click();
    });
});
// ---------------

// Initialization


export {};