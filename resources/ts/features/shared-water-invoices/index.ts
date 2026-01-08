// UI ELEMENTS
const deleteRentInvoiceButtons= document.querySelectorAll(".delete-rent-invoice-btn");
const  sharedValue:HTMLInputElement = document.querySelector('#shared_value')!;
const  amount:HTMLInputElement = document.querySelector('#amount')!;
const  remaining:HTMLInputElement= document.querySelector('#remaining')!;
// ---------------

// CORE
// ---------------

// EVENTS
deleteRentInvoiceButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
        (btn.parentElement?.querySelector( ".delete-submit-btn") as HTMLElement).click();
    });
});

amount.addEventListener('input', ()=>{
    const remaining_ = +sharedValue.value - +amount.value 
    remaining.value = (remaining_ < 0 ? 0 : remaining_).toString(); 
    
});
// ---------------

// EVENT HANDLER
// ---------------

// Initialization
// ---------------

export {};
