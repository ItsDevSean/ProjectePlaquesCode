// Open detail with the values of the panel
function openDetail(panel, nameAtributes) {
    console.log("the streeets have no nameeeee")
    processAttributes(panel,nameAtributes);
    toggleDetail();
}   
function processAttributes(panel,nameAtributes) {
    document.getElementById('detailTitle').textContent = "Detalle de " + panel.panel_model;
    nameAtributes.forEach(na => {
        if (na != 'user_id') {
            // Ensure the element exists before setting textContent
            const element = document.getElementById("detail_"+na);
            if (element) {
                element.textContent = panel[na] !== null ? panel[na] : 'N/A'; 
                console.log("Set " + na + ": " + panel[na]); 
            } else {
                console.log("Element not found for: " + na);
            }
        }
    });
}
// Open and close the detail pop up
function toggleDetail() {
    document.getElementById('detail').classList.toggle('hidden');
}
function showImport(importedData) {
    console.log('Imported Data:', importedData);
}
