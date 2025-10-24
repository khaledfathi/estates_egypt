// UI ELEMENTS
const deleteUtilityServiceButton: HTMLElement = document.querySelector(
        "#delete-utility-service-btn"
    )!,
    deleteUtilityServiceSubmitButton: HTMLElement = document.querySelector(
        "#delete-utility-service-submit-btn"
    )!,
    //for invoices
    deleteInvoiceButtons: NodeListOf<HTMLElement> = document.querySelectorAll(
        ".delete-invoice-btn"
    )!;
// ---------------

// CORE
// ---------------

// EVENTS
deleteUtilityServiceButton.addEventListener("click", (e: Event) => {
    deleteUtilityServiceSubmitButton.click();
});
deleteInvoiceButtons.forEach((button: HTMLElement) => {
    const submitButton: HTMLElement = button.nextElementSibling as HTMLElement;
    button.addEventListener("click", (e: Event) => {
        submitButton.click();
    });
});
// ---------------

// EVENT HANDLER
// ---------------

// Initialization

export {};
