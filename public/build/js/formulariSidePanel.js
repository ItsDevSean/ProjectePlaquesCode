document.addEventListener("DOMContentLoaded", function () {
    const edificiData = JSON.parse(localStorage.getItem("edificiData"));
  
    if (edificiData) {
      document.getElementById("latitud").value = edificiData.lat;
      document.getElementById("longitud").value = edificiData.lng;
      document.getElementById("inclinacion").value = edificiData.inclinacion;
      document.getElementById("area").value = edificiData.area; 
  
      localStorage.removeItem("edificiData");
    }
  
    const urlParams = new URLSearchParams(window.location.search);
    const lat = urlParams.get("lat");
    const lng = urlParams.get("lng");
    const inclinacion = urlParams.get("inclinacion");
    const area = urlParams.get("area");
  
    if (lat && lng && inclinacion && area) {
      document.getElementById("latitud").value = lat;
      document.getElementById("longitud").value = lng;
      document.getElementById("inclinacion").value = inclinacion;
      document.getElementById("area").value = area; 
    }
});