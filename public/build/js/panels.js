

function toggleModal() {
    document.getElementById('modal').classList.toggle('hidden');
}

function openDetail(panel) {
    // Open pop up
    toggleDetail();
    
    // Update the pop up with the panel data
    document.getElementById('modalModel').textContent = panel.panel_model;
    document.getElementById('modalManufacturer').textContent = panel.manufacturer;
    document.getElementById('modalType').textContent = panel.panel_type;
    document.getElementById('modalDate').textContent = panel.date_manufacturer;
    document.getElementById('modalWarranty').textContent = panel.panel_warranty;
    document.getElementById('modalPerformanceWarranty').textContent = panel.performance_warranty;
}

function toggleDetail() {
    // Toggle the pop up:
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