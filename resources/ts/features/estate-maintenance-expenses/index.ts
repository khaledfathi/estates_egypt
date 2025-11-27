// UI ELEMENTS
const 
    deleteExpenseButtons:NodeListOf<HTMLElement>= document.querySelectorAll(".delete-expense-btn")!;
// ---------------

// CORE
// ---------------

// EVENTS
deleteExpenseButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
        (btn.parentElement?.querySelector( ".delete-submit-btn") as HTMLElement).click();
    });
});
// ---------------

// EVENT HANDLER
// ---------------

// Initialization


export {};
