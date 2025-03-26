function formSubmit(event) {
    // Prevent default form submission
    event.preventDefault();
    //Prepare the form
    const form = document.getElementById('panelForm');
    const superficieInput = document.getElementById('superficie'); 
    if (!form) {
        console.error("Form not found!");
        return;
    }
    const longitudInput = document.getElementById('longitud_v2');
    const anchuraInput = document.getElementById('anchura');
    if (!longitudInput || !anchuraInput || !superficieInput) {
        console.error("Missing required inputs!");
        return;
    }
    if (longitudInput.value < 1000 || anchuraInput.value < 500) {
        console.log("Litle");
        document.getElementById('msg_error').textContent = "La altura o la anchura son demasiado pequeños.";
        return;
    }
    // Calculate the area
    const longitud = parseFloat(longitudInput.value) || 0;
    const anchura = parseFloat(anchuraInput.value) || 0;
    const area = ((longitud / 1000) * (anchura / 1000)) // convert mm to m
    superficieInput.value = area
    //Now submit the form after updating the input
    form.submit();
    //Todo: Fetch the validation and only close the view
    //if the validation is coorect
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
// Open and close form
function toggleModal() {
    document.getElementById('modal').classList.toggle('hidden');
}
