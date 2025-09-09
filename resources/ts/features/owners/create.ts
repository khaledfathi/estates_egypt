// UI ELEMENTS
const 
    addPhoneButton:HTMLElement = document.querySelector("#add-phone-btn")!,
    phoneBox:HTMLElement = document.querySelector(".phone-box")!,
    phoneFormGroup:HTMLElement = document.querySelector("#phone-form-group")!,
    removePhoneButtons= document.querySelectorAll(".remove-phone-btn")!;
// ---------------

// CORE

function addPhoneInputElement() {
    //clone the phone box
    let clonedPhoneBox = phoneBox.cloneNode(true) as HTMLElement;
    clonedPhoneBox.removeAttribute("hidden");
    clonedPhoneBox.querySelector('.phones')!.setAttribute("name", "phones[]");
    let removeBtn = clonedPhoneBox.querySelector('.remove-phone-btn')!;
    removeBtn.addEventListener('click', ()=>clonedPhoneBox.remove());
    // append the cloned phone box to the form group
    phoneFormGroup.appendChild(clonedPhoneBox);
    return clonedPhoneBox;
}

function removeParent (element:HTMLElement ){
    element.parentElement?.remove();
}
// ---------------

// EVENTS
addPhoneButton.addEventListener("click", addPhoneButtonClickHandler);
removePhoneButtons.forEach(btn=> {
    btn.addEventListener('click' , ()=> removeParent(btn as HTMLElement));
});
// ---------------

// EVENT HANDLER
function addPhoneButtonClickHandler() {
    addPhoneInputElement();
}
// ---------------

// Initialization
(()=>{
    //remove initial phone box
    phoneBox.remove();
})();


export {};