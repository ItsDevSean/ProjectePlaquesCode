

function toggleModal() {
    document.getElementById('modal').classList.toggle('hidden');
}


// Open detail with the values of the panel
function openDetail(panel, nameAtributes) {
    if (document.readyState == 'complete') {
        console.log("DOM fully loaded and parsed");
        processAttributes(panel,nameAtributes);
    } else {
        console.log("not loaded")
        document.addEventListener('DOMContentLoaded', function() {
            processAttributes(panel,nameAtributes);
        });
    }
    toggleDetail();
}   
function processAttributes(panel,nameAtributes) {
    nameAtributes.forEach(na => {
        // Ensure the element exists before setting textContent
        const element = document.getElementById(na);
        if (element) {
            element.textContent = panel[na] !== null ? panel[na] : 'N/A'; 
            console.log("Set " + na + ": " + panel[na]); 
        } else {
            console.log("Element not found for: " + na);
        }
    });
}
// Open and close the detail pop up
function toggleDetail() {
    document.getElementById('deteil').classList.toggle('hidden');
}

function formSubmit(event) {
    event.preventDefault(); // Prevent default form submission

    const form = document.getElementById('panelForm');
    const superficieInput = document.getElementById('superficie'); 

    if (!form) {
        console.error("Form not found!");
        return;
    }

    // Get the values from the form
    const longitudInput = document.getElementById('longitud');
    const anchuraInput = document.getElementById('anchura');

    if (!longitudInput || !anchuraInput || !superficieInput) {
        console.error("Missing required inputs!");
        return;
    }

    // Calculate the area
    const longitud = parseFloat(longitudInput.value) || 0;
    const anchura = parseFloat(anchuraInput.value) || 0;
    const area = (longitud * anchura)  
    superficieInput.value = area //Update the area of the panel

    //Fetch the validation and only close the view
    //if the validation is coorect


    // Now submit the form after updating the input
    form.submit();
}

// Triger the formSubmit when button is click
document.addEventListener('DOMContentLoaded', function () {
    const submitButton = document.getElementById("submitButton");
    if (submitButton) {
        submitButton.addEventListener("click", formSubmit);
    } else {
        console.error("Submit button not found!");
    }
});