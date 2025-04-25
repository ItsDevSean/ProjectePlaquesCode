// Function that prces the form before the submit
function formSubmit(event) {
    event.preventDefault();
    const form = document.getElementById('panelForm');
    if (!form) {
        console.error("Form not found!");
        return;
    }
    const superficieInput = document.getElementById('superficie'); 
    const longitudInput = document.getElementById('longitud_v2');
    const anchuraInput = document.getElementById('anchura');
    if (!errorHandler()) {
        console.log("Ostia todos los canvios");
        return;
    }
    console.log("Que oassas");
    // Calculate the area
    const longitud = parseFloat(longitudInput.value) || 0;
    const anchura = parseFloat(anchuraInput.value) || 0;
    const area = ((longitud / 1000) * (anchura / 1000)) // convert mm to m
    superficieInput.value = area
    //Now submit the form after updating the input
    form.submit();
}
// Function that shows the errors of the form submition
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

      // List all fields in order you want them checked
      const fieldsToCheck = [
        { id: 'panel_model', required: true, name: 'Nombre del Modelo' },
        { id: 'fabricante_id', required: true, name: 'Fabricante' },
        { id: 'date_manufacturer', required: true, name: 'Fecha de Fabricación' },
        { id: 'potencia_maxima', required: true, name: 'Potencia Nominal' },
        { id: 'coeficiente_temp_pmax', required: true, name: 'Coef. Temp. Potencia' },
        { id: 'longitud_v2', required: true, name: 'Longitud' },
        { id: 'anchura', required: true, name: 'Anchura' },
        { id: 'espesor', required: true, name: 'Espesor' },
        { id: 'peso', required: true, name: 'Peso' },
        { id: 'eficencia_panel', required: true, name: 'Eficiencia' },
        { id: 'panel_warranty', required: false, name: 'Garantía Producto' },
        { id: 'performance_warranty', required: false, name: 'Garantía Rendimiento' },
    ];

    // Check for empty required fields first
    for (const field of fieldsToCheck) {
        const element = document.getElementById(field.id);
        if (field.required && !element.value) {
            element.focus();
            return false;
        }
    }
    if (isCorrect && longitudInput.value < 1000 || isCorrect && anchuraInput.value < 500) {
        console.log("with out with out you")
        const errorMsgLonAnc = document.getElementById("errorAltura");
        errorMsgLonAnc.textContent = "";
        const errorMsgAnc = document.getElementById("errorAnchura");
        errorMsgAnc.textContent = ""; 
        errorMsgLonAnc.textContent = "La altura o la anchura son demasiado pequeñas.";
        longitudInput.focus();
        isCorrect = false;
    }
    if (isCorrect && eficienciaInput.value > 99) {
        const errorMsgEficiencia = document.getElementById("errorEficiencia");
        errorMsgEficiencia.textContent = "";
        errorMsgEficiencia.textContent = "Eficiència ha de ser menor de 100";
        eficienciaInput.focus();
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
