

function toggleModal() {
    document.getElementById('modal').classList.toggle('hidden');
}

function formSubmit(event) {
    event.preventDefault(); // Prevent default form submission

    console.log("Hello World");

    const form = document.getElementById('panelForm');
    const superficieInput = document.getElementById('superficie'); 

    if (!form) {
        console.error("Form not found!");
        return;
    }

    console.log("Form found!", form);

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
    const area = (longitud * anchura)  // Convert mm² to m²
    superficieInput.value = area

    // Log the values
    console.log("L:", longitud);
    console.log("A:", anchura);
    console.log("Area:", superficieInput.value);

    // Now submit the form after updating the input
    form.submit();
}

// Attach the function to the submit button click
document.addEventListener('DOMContentLoaded', function () {
    const submitButton = document.getElementById("submitButton");
    if (submitButton) {
        submitButton.addEventListener("click", formSubmit);
    } else {
        console.error("Submit button not found!");
    }
});