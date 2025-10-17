// UI ELEMENTS
const optionRadioButton: NodeListOf<HTMLInputElement> =
    document.querySelectorAll("input[name='store-option']");

//option sections
const storeOptionSectionsElements: HTMLElement[] = [
    document.querySelector("#single-owner-section")!,
    document.querySelector("#multiple-owners-section")!,
    document.querySelector("#groups-of-owners-section")!,
];
// ---------------


// CORE
function selectStoreOptionSection(value: string) {
    switch (value) {
        case 'single-owner':
            showSingleElement(storeOptionSectionsElements, 0);
            break;
        case 'multiple-owners':
            showSingleElement(storeOptionSectionsElements, 1);
            break;
        case 'groups-of-owners':
            showSingleElement(storeOptionSectionsElements, 2);
            break;
    }
}
function showSingleElement(elementsArray: HTMLElement[], showIndex: number) {
    elementsArray.forEach((element) => element.setAttribute("hidden", "true"));
    elementsArray[showIndex]?.removeAttribute("hidden");
}
// ---------------

// EVENTS
optionRadioButton.forEach((radio) => {
    radio.addEventListener("change", () => {
        console.log(radio.value);
        selectStoreOptionSection(radio.value);
    });
});
// ---------------

// EVENT HANDLER
// ---------------

// Initialization

export {};
