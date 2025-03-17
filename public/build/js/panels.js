function toggleModal() {
    document.getElementById('modal').classList.toggle('hidden');
}

document.addEventListener('DOMContentLoaded', function () {
    console.log("Hellooo World");

   
    const form = document.querySelector('form'); 
    //const superficieInput = document.getElementById('superficie'); 
    if (!form) {
        console.error("Form not found!");
        
    } else {
        console.log("Form found!", form); // Add this to verify the form is found

        form.addEventListener('submit', function (event) {
            console.log("Submit event triggered!"); 
            event.preventDefault();
            event.stopImmediatePropagation(); 
            console.log("Form submitted!");
            

            // Get the values from the form
            const longitudInput = document.getElementById('longitud');
            const anchuraInput = document.getElementById('anchura');

                // Debug the input values
            console.log("Longitud input value:", longitudInput.value);
            console.log("Anchura input value:", anchuraInput.value);

            // Calculate the area
            const longitud = parseFloat(longitudInput.value) || 0;
            const anchura = parseFloat(anchuraInput.value) || 0;
            const area = (longitud * anchura) / 1000000; // Convert mm² to m²
            superficieInput.value = area.toFixed(2); // Update the superficie input

            // Log the values
            console.log("L: " + longitud);
            console.log("A: " + anchura);
            console.log("Area: " + area);

            //Whait validation of the controller.

                //If the data is wrong, do not close the pop up
                //and sow the errors


                //If the data is good, close the pop up 
                // afeter the data is in the DB.
        
        });
    }


    
    
    
});
