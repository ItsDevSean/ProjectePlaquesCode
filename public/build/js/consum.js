document.addEventListener('DOMContentLoaded', function() {
    //Guardar consum anula
    const consumAnual = document.getElementById('consum-anual');
    consumAnual.addEventListener('change', guardarInclinacion);
    function guardarInclinacion() {
        const consumAnualValue = consumAnual.value;
        localStorage.setItem('consumAnual', consumAnualValue);
    }


    //Guardar consum anula
    const facturaAnual = document.getElementById('factura-anual');
    facturaAnual.addEventListener('change', guardarFacturaAnual);
    function guardarFacturaAnual() {
        const facturaAnualValue = facturaAnual.value;
        localStorage.setItem('facturaAnual', facturaAnualValue);
    }

    //Guardar cost instalacio
    const costInstalacio = document.getElementById('coste-instalacion');
    costInstalacio.addEventListener('change', guardarCostInstalacio);
    function guardarCostInstalacio() {
        const costInstalacioValue = costInstalacio.value;
        localStorage.setItem('costInstalacio', costInstalacioValue);
    }

    //Guardar subencions
    const subencions = document.getElementById('subvenciones');
    subencions.addEventListener('change', guardarSubencions);
    function guardarSubencions() {
        const subencionsValue = subencions.value;
        localStorage.setItem('subencions', subencionsValue);
    }

    //Guardar preu excedents
    const preuExcedents = document.getElementById('precio-excedentes');
    preuExcedents.addEventListener('change', guardarpreuExcedents);
    function guardarpreuExcedents() {
        const preuExcedentsValue = preuExcedents.value;
        localStorage.setItem('preuExcedents', preuExcedentsValue);
    }

    // Guardar tarifa Acces
    const tarifaAcces = document.getElementById('tarifa-acces');
    tarifaAcces.addEventListener('change', guardarTarifaAcces);
    function guardarTarifaAcces() {
        const selectedOption = tarifaAcces.options[tarifaAcces.selectedIndex];
        const tarifaAccesValue = selectedOption.textContent.trim();
        localStorage.setItem('tarifaAcces', tarifaAccesValue);
    }

    // Guardar patro consum
    const buttonDiurn = document.getElementById('button_diurn');
    buttonDiurn.addEventListener('click', guardarButtonDiurn);
    function guardarButtonDiurn() {
        const buttonDiurnValue = document.getElementById("diurn").textContent;
        localStorage.setItem('buttonDiurn', buttonDiurnValue);
    }

    const buttonNocturn = document.getElementById('button_nocturn');
    buttonNocturn.addEventListener('click', guardarButtonNocturn);
    function guardarButtonNocturn() {
        const buttonNocturnValue = document.getElementById("nocturn").textContent;
        localStorage.setItem('buttonNocturn', buttonNocturnValue);
    }

    const buttonMist = document.getElementById('button_mixt');
    buttonMist.addEventListener('click', guardarbuttonMist);
    function guardarbuttonMist() {
        const buttonMistValue = document.getElementById("mixt").textContent;
        localStorage.setItem('buttonMist', buttonMistValue);
    }
})

