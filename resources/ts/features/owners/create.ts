// UI ELEMENTS
const 
    //for phone section
    addPhoneButton:HTMLElement = document.querySelector("#add-phone-btn")!,
    phoneBox:HTMLElement = document.querySelector(".phone-box")!,
    phoneFormGroup:HTMLElement = document.querySelector("#phone-form-group")!,
    removePhoneButtons:NodeListOf<HTMLElement>= document.querySelectorAll(".remove-phone-btn")!,
    //for owenrGroup section
    addOwnerGroupButton :HTMLElement = document.querySelector('#add-owner-group-btn')!,
    ownerGroupBox:HTMLElement = document.querySelector('.owner-group-box')!,
    ownerGroupFormGroup:HTMLElement = document.querySelector('#owner-group-form-group')!,
    removeOwnerGroupButtons:NodeListOf<HTMLElement>= document.querySelectorAll(".remove-owner-group-buttons")!;
    console.log()

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
function addOwnerGroupInputElement () {
    //clone the ownerGroup box
    let clonedOwnerGroupBox = ownerGroupBox.cloneNode(true) as HTMLElement;
    clonedOwnerGroupBox.removeAttribute("hidden");
    clonedOwnerGroupBox.querySelector('.owner-groups')!.setAttribute("name", "owner_groups[]");
    let removeBtn = clonedOwnerGroupBox.querySelector('.remove-owner-group-btn')!;
    removeBtn.addEventListener('click', ()=>clonedOwnerGroupBox.remove());
    // append the cloned onwerGroup box to the form group
    ownerGroupFormGroup.appendChild(clonedOwnerGroupBox);
    return clonedOwnerGroupBox;
}

function removeParent (element:HTMLElement ){
    element.parentElement?.remove();
}
// ---------------

// EVENTS
//-- for phones section
addPhoneButton.addEventListener("click", addPhoneButtonClickHandler);
removePhoneButtons.forEach(btn=> {
    btn.addEventListener('click' , ()=> removeParent(btn as HTMLElement));
});
//-- for ownergroups section 
addOwnerGroupButton.addEventListener("click", addOwnerGroupButtonClickHandler);
removeOwnerGroupButtons.forEach(btn=> {
    btn.addEventListener('click' , ()=> removeParent(btn as HTMLElement));
});
// ---------------

// EVENT HANDLER
function addPhoneButtonClickHandler() {
    addPhoneInputElement();
}
function addOwnerGroupButtonClickHandler() {
    addOwnerGroupInputElement();
}
// ---------------

// Initialization
(()=>{
    //remove initial phone box
    phoneBox.remove();
    ownerGroupBox.remove();
})();


export {};