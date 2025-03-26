// Open detail with the values of the panel
function openDetail(panel, nameAtributes) {
    processAttributes(panel,nameAtributes);
    toggleDetail();
}   
function processAttributes(panel,nameAtributes) {
    document.getElementById('modalModel').textContent = panel.panel_model;
    nameAtributes.forEach(na => {
        if (na != 'panel_model' && na != 'user_id') {
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
