import SunCalc from 'suncalc';

const selectPanel = document.getElementById("panel_model");
console.log("not going back");
selectPanel.addEventListener("change", function() {
    console.log("Raimon es menja una barreta energetica...")
    let solarElevationDegrees = 0;
    const place = autocomplete.getPlace();
    const lat = place.geometry.location.lat();
    const lng = place.geometry.location.lng();
    const position = SunCalc.getPosition(new Date(), lat, lng);
    solarElevationDegrees = position.altitude * (180 / Math.PI);
    console.log(`I see seven towers but ...: ${solarElevationDegrees.toFixed(2)}°`);
});
