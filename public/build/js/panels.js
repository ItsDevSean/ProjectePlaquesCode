function toggleModal() {
    document.getElementById('modal').classList.toggle('hidden');
}

document.addEventListener('DOMContentLoaded', function addPanel() {
    //Get the values from the form:
    const longitudInput = document.getElementById('longitud');
    const anchuraInput = document-this.getElementById('anchura');

    //Calculate
    function calculateArea() {
        const longitud = parseFloat(longitudInput.value) || 0;
        const anchura = parseFloat(anchuraInput.value) || 0;
        const area = (longitud * anchura) / 1000000; // Convert mm² to m²
        superficieInput.value = area.toFixed(2); // Round to 2 decimal places
    }


    //Send the values to the controller
    

    //Whait validation of the controller.

        //If the data is wrong, do not close the pop up
        //and sow the errors


        //If the data is good, close the pop up 
        // afeter the data is in the DB.
    }
);
