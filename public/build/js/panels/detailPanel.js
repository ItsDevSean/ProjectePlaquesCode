const { raw } = require("alpinejs");

// Open detail with the values of the panel
function openDetail(panel, nameAtributes) {
    console.log("the streeets have no nameeeee")
    processAttributes(panel,nameAtributes);
    toggleDetail();
}   
function processAttributes(panel,nameAtributes) {
    document.getElementById('detailTitle').textContent = "Detalle de " + panel.panel_model;
    console.log("ground control " + nameAtributes);
    nameAtributes.forEach(na => {
        if (na != 'user_id') {
            // Ensure the element exists before setting textContent
            const element = document.getElementById("detail_"+na);
            if (element || na == "fabricante_id") {
                console.log("Turn agin, no turn your self " + na)
                if (na == "superficie") {
                    console.log("Nothing will help us " + panel[na] / 1000)
                    const superficieM = panel[na] / 1000
                    element.textContent = superficieM !== null ? superficieM : 'N/A';    
                } else if (na == "fabricante_id") {
                    const manufacturer = getManufacturer(panel["fabricante_id"])
                    console.log("glowing glowing gdf " + manufacturer);
                    element.textContent = manufacturer;
                } else {
                    element.textContent = panel[na] !== null ? panel[na] : 'N/A';
                }  
            } 
        }
        
    });
}
function getManufacturer(manufacturerId) {
    let fabricanteName = "";
    
    const rawFabricantes = document.getElementById('fabricantes_values').value;
    const fabricantes = JSON.parse(rawFabricantes);
    fabricantes.forEach(f => {
        if (f.id == manufacturerId) {
            fabricanteName = f.nombre; 
        }
    })
    return fabricanteName;
}
// Open and close the detail pop up
function toggleDetail() {
    document.getElementById('detail').classList.toggle('hidden');
}
function showImport(importedData) {
    console.log('Imported Data:', importedData);
}
