function formSubmit(event) {
    // Prevent default form submission
    event.preventDefault();
    //Prepare the form
    const form = document.getElementById('panelForm');
    if (!form) {
        console.error("Form not found!");
        return;
    }
    const superficieInput = document.getElementById('superficie'); 
    const longitudInput = document.getElementById('longitud_v2');
    const anchuraInput = document.getElementById('anchura');
    // See if there ara errors
    if (!errorHandler()) {
        return;
    }
    // Calculate the area
    const longitud = parseFloat(longitudInput.value) || 0;
    const anchura = parseFloat(anchuraInput.value) || 0;
    const area = ((longitud / 1000) * (anchura / 1000)) // convert mm to m
    superficieInput.value = area
    //Now submit the form after updating the input
    form.submit();
}
function errorHandler() {
    let isCorrect = true;
    // Get the elements that habe to validate
    const nombreModelo = document.getElementById('panel_model');
    const fabicante = document.getElementById('manufacturer');
    const fechaFabricacion = document.getElementById('date_manufacturer');
    const espesor = document.getElementById('espesor');
    const peso = document.getElementById('peso');
    const potenciaMaxima = document.getElementById('potencia_maxima');
    const coeficienteTemp = document.getElementById('coeficiente_temp_pmax');
    const longitudInput = document.getElementById('longitud_v2');
    const anchuraInput = document.getElementById('anchura');
    const eficienciaInput = document.getElementById('eficencia_panel');
    const errorElement = document.getElementById('msg_error');
    if (!nombreModelo || !fabicante || !fechaFabricacion || 
        !espesor || !peso || !potenciaMaxima || !coeficienteTemp || 
        !longitudInput || !anchuraInput) {
        errorElement.textContent = "Faltan campos obligatorios.";
        isCorrect = false;
    }
    if (!isCorrect && longitudInput.value < 1000 || anchuraInput.value < 500) {
        errorElement.textContent = "La altura o la anchura son demasiado pequeñas.";
        isCorrect = false;
    }
    if (!isCorrect && eficienciaInput.value > 99) {
        errorElement.textContent = "Eficiència ha de ser menor de 100"
        console.log("fefef");
        isCorrect = false;
    }
    return isCorrect;
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
