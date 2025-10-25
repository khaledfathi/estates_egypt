//CONSTANTS
const OWNER_LIST_OPTION = "owners-list";
const GROUPS_OF_OWNERS_OPTION = "groups-of-owners";

// UI ELEMENTS
const optionRadioButtons: NodeListOf<HTMLInputElement> =
        document.querySelectorAll("input[name='store-option']"),
    //owners-list section elements 
    ownerParentDiv:HTMLElement = document.querySelector('#owner-parent-div')!,
    ownerBox:HTMLElement = document.querySelector('.owner-box')!,
    removeOwnerButtons:NodeListOf<HTMLElement>= document.querySelectorAll('.remove-owner-btn')!,
    addOwnerButton:HTMLElement = document.querySelector('#add-owner-btn')!,
    //owners-groups-list section elements 
    groupsParentDiv:HTMLElement = document.querySelector('#groups-parent-div')!,
    groupsBox:HTMLElement = document.querySelector('.groups-box')!,
    removeGroupsButtons:NodeListOf<HTMLElement>= document.querySelectorAll('.remove-group-btn')!,
    addGroupsButton:HTMLElement = document.querySelector('#add-group-btn')!,

    //option sections
    storeOptionSectionsElements: HTMLElement[] = [
        document.querySelector("#owners-list-section")!,
        document.querySelector("#groups-of-owners-section")!,
    ];
// ---------------

// CORE
/**
 * show selected form section depend on radio buttons {@link optionRadioButtons}
 * @param value selected option name
 */
function selectStoreOptionSection(value: string):void {
    switch (value) {
        case OWNER_LIST_OPTION:
            showSingleElement(storeOptionSectionsElements, 0);
            break;
        case GROUPS_OF_OWNERS_OPTION:
            showSingleElement(storeOptionSectionsElements, 1);
            break;
    }
}
/**
 *  add hide attribute to all element in array ,
 *  and remove hide attribute from only selected one by index {@link showIndex}
 * @param {array<HTMLElement>} elementsArray  
 * @param {number} showIndex 
 */
function showSingleElement(elementsArray: HTMLElement[], showIndex: number):void {
    elementsArray.forEach((element) => element.setAttribute("hidden", "true"));
    elementsArray[showIndex]?.removeAttribute("hidden");
}
// ---
function addOwnerInputElement():HTMLElement {
    //clone the phone box
    let clonedOwnerBox = ownerBox.cloneNode(true) as HTMLElement;
    clonedOwnerBox.removeAttribute("hidden");
    clonedOwnerBox.querySelector(".owners-select")!.setAttribute("name", "owners[]");
    let removeBtn = clonedOwnerBox.querySelector(".remove-owner-btn")!;
    removeBtn.addEventListener("click", () => clonedOwnerBox.remove());
    // append the cloned phone box to the form group
    ownerParentDiv.appendChild(clonedOwnerBox);
    return clonedOwnerBox;
}

function addGroupInputElement():HTMLElement {
    //clone the phone box
    let clonedGroupBox = groupsBox.cloneNode(true) as HTMLElement;
    clonedGroupBox.removeAttribute("hidden");
    clonedGroupBox.querySelector(".groups-select")!.setAttribute("name", "groups[]");
    let removeBtn = clonedGroupBox.querySelector(".remove-group-btn")!;
    removeBtn.addEventListener("click", () => clonedGroupBox.remove());
    // append the cloned phone box to the form group
    groupsParentDiv.appendChild(clonedGroupBox);
    return clonedGroupBox;
}

function removeParent(element: HTMLElement):void {
    element.parentElement?.remove();
}
// ---------------

// EVENTS
optionRadioButtons.forEach((radio) => {
    radio.addEventListener("change", () => {
        console.log(radio.value);
        selectStoreOptionSection(radio.value);
    });
});
window.addEventListener("DOMContentLoaded", eventOnDOMContentLoadedHandler);
//--
//-- for phones section
addOwnerButton.addEventListener("click", addOwnerButtonClickHandler);

removeOwnerButtons.forEach((btn) => {
    btn.addEventListener("click", () => removeParent(btn as HTMLElement));
});

addGroupsButton.addEventListener("click", addGroupButtonClickHandler);

removeGroupsButtons.forEach((btn) => {
    btn.addEventListener("click", () => removeParent(btn as HTMLElement));
});
// ---------------

// EVENT HANDLER
function addOwnerButtonClickHandler() {
    addOwnerInputElement();
}
function addGroupButtonClickHandler() {
    addGroupInputElement();
}
function eventOnDOMContentLoadedHandler():void {
    const optionRadios: NodeListOf<HTMLInputElement> =
        document.querySelectorAll("input[name='store-option']");
    selectStoreOptionSection(OWNER_LIST_OPTION);
    optionRadios.forEach((radio) => {
        radio.removeAttribute("checked");
        if (radio.value == OWNER_LIST_OPTION) {
            radio.checked = true;
        }
    });
}
// ---------------

// Initialization
(() => {
    //remove initial phone box
    ownerBox.remove();
    groupsBox.remove();
})();

export {};
