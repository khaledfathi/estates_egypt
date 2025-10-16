
// UI ELEMENTS
const 
    deleteOwnerSubmitButton:HTMLElement = document.querySelector("#delete-owner-submit-btn")!,
    deleteOwnershipButtons:NodeListOf<HTMLElement>= document.querySelectorAll(".delete-owner-btn")!;
// ---------------

// CORE
// ---------------

// EVENTS
deleteOwnershipButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
        (btn.parentElement?.querySelector( ".delete-submit-btn") as HTMLElement).click();
    });
});
// ---------------

// EVENT HANDLER
// ---------------

// Initialization


export {};
