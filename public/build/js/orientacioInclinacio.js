document.addEventListener("DOMContentLoaded", function () {
    
    // Funcionalitat del acordió
    const accordionButtons = document.querySelectorAll(".accordion-button");

    accordionButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const section = this.parentElement;
            section.classList.toggle("active");

            if (section.classList.contains("active")) {
                document.querySelectorAll(".accordion-section").forEach((s) => {
                    if (s !== section && s.classList.contains("active")) {
                        s.classList.remove("active");
                    }
                });
            }
        });
    });

    // Obrir la primera secció per defecte
    document.querySelector(".accordion-section").classList.add("active");

    // Selector d'Inclinació
    const inclinationSVG = document.querySelector(".inclination-svg");
    const inclinationHandle = document.getElementById("inclination-handle");
    const inclinationLine = document.getElementById("inclination-line");
    const inclinationDegreeDisplay =
        document.getElementById("inclination-degree");
    const inclinationInput = document.getElementById("inclinacion");

    if (
        inclinationSVG &&
        inclinationHandle &&
        inclinationLine &&
        inclinationDegreeDisplay &&
        inclinationInput
    ) {
        const center = { x: 80, y: 80 };
        const radius = 70;
        const minInclination = 0;
        const maxInclination = 90;

        let isDraggingInclination = false;

        // Funció per actualitzar la visualització de la inclinació
        function updateInclinationVisuals(inclination) {
            inclination = Math.max(
                minInclination,
                Math.min(maxInclination, inclination)
            );
            const inc = localStorage.getItem(`user_${window.userId}_lat`)
            // Convertir inclinació a angle SVG
            const svgAngleDeg = inclination + 180;
            const svgAngleRad = svgAngleDeg * (Math.PI / 180);

            // Calcular nova posició del handle
            const hx = center.x + radius * Math.cos(svgAngleRad);
            const hy = center.y + radius * Math.sin(svgAngleRad);

            // Actualitzar posició visual
            inclinationHandle.setAttribute("cx", hx);
            inclinationHandle.setAttribute("cy", hy);
            inclinationLine.setAttribute("x2", hx);
            inclinationLine.setAttribute("y2", hy);

            // Actualitzar text
            console.log("jjjjjjj")
            inclinationDegreeDisplay.textContent = inclination + "°";
            

            // Actualitzar input
            inclinationInput.value = inclination;
        }

        // Funció per guardar la inclinació al localStorage
        function saveInclinationToLocalStorage(value) {
            const storageKey = window.userId
                ? `user_${window.userId}_inclinacion`
                : "default_inclinacion";
            localStorage.setItem(storageKey, value);
        }

        // Funció per inicialitzar la inclinació
        function initializeInclination() {
            
            const storageKey = window.userId
                ? `user_${window.userId}_inclinacion`
                : "default_inclinacion";
            const savedInclination = localStorage.getItem(storageKey);

            let initialInclination = localStorage.getItem(`user_${userId}_lat`);

            if (savedInclination !== null && !isNaN(savedInclination)) {
                initialInclination = parseFloat(savedInclination);
            } else if (
                inclinationInput.value !== "" &&
                !isNaN(inclinationInput.value)
            ) {
                initialInclination = parseFloat(inclinationInput.value);
            }

            updateInclinationVisuals(Math.round(initialInclination));
        }

        // Event Listeners
        inclinationHandle.addEventListener("mousedown", startInclinationDrag);
        inclinationSVG.addEventListener("mousemove", dragInclination);
        document.addEventListener("mouseup", endInclinationDrag);

        // Suport tàctil
        inclinationHandle.addEventListener("touchstart", startInclinationDrag, {
            passive: false,
        });
        inclinationSVG.addEventListener("touchmove", dragInclination, {
            passive: false,
        });
        document.addEventListener("touchend", endInclinationDrag);

        function startInclinationDrag(e) {
            e.preventDefault();
            isDraggingInclination = true;
            inclinationSVG.style.cursor = "grabbing";
        }

        function dragInclination(e) {
            if (!isDraggingInclination) return;
            e.preventDefault();

            const coords = getSVGCoordinates(e, inclinationSVG);

            // Calcular angle
            const dx = coords.x - center.x;
            const dy = coords.y - center.y;
            let svgAngleRad = Math.atan2(dy, dx);
            let svgAngleDeg = svgAngleRad * (180 / Math.PI);

            // Convertir angle SVG a inclinació (0-90)
            let inclination = 0;
            let normalizedSvgAngleDeg = ((svgAngleDeg % 360) + 360) % 360;

            if (normalizedSvgAngleDeg >= 90 && normalizedSvgAngleDeg <= 180) {
                inclination = 0;
            } else if (
                normalizedSvgAngleDeg > 180 &&
                normalizedSvgAngleDeg <= 270
            ) {
                inclination = normalizedSvgAngleDeg - 180;
            } else {
                inclination = 90;
            }

            // Limitar i arrodonir
            inclination = Math.max(
                minInclination,
                Math.min(maxInclination, inclination)
            );
            updateInclinationVisuals(Math.round(inclination));
        }

        function endInclinationDrag() {
            if (isDraggingInclination) {
                isDraggingInclination = false;
                inclinationSVG.style.cursor = "grab";
                saveInclinationToLocalStorage(
                    Math.round(parseFloat(inclinationInput.value))
                );
            }
        }

        function getSVGCoordinates(e, svgElement) {
            const pt = svgElement.createSVGPoint();
            if (e.type.includes("touch")) {
                pt.x = e.touches[0].clientX;
                pt.y = e.touches[0].clientY;
            } else {
                pt.x = e.clientX;
                pt.y = e.clientY;
            }
            const svgPoint = pt.matrixTransform(
                svgElement.getScreenCTM().inverse()
            );
            return { x: svgPoint.x, y: svgPoint.y };
        }

        // Inicialització
        initializeInclination();
    }

    // Selector d'Orientació - Versió actualitzada per guardar grau exacte
    const orientationSVG = document.querySelector(".orientation-svg");
    const orientationHandle = document.getElementById("dial-handle");
    const orientationLine = document.getElementById("dial-line");
    const orientationDegreeDisplay =
        document.getElementById("orientation-degree");
    const orientationCardinalDisplay = document.getElementById(
        "orientation-cardinal"
    );
    const orientationHiddenInput = document.getElementById("orientacion");

    if (
        orientationSVG &&
        orientationHandle &&
        orientationLine &&
        orientationDegreeDisplay &&
        orientationCardinalDisplay &&
        orientationHiddenInput
    ) {
        const center = { x: 100, y: 100 };
        const radius = 70;

        // Mapeig d'angles a direccions cardinals
        const angleToCardinal = {
            norte: { min: 315, max: 45, value: 0, label: "Nord" },
            este: { min: 45, max: 135, value: 90, label: "Est" },
            sur: { min: 135, max: 225, value: 180, label: "Sud" },
            oeste: { min: 225, max: 315, value: 270, label: "Oest" },
        };

        // Funció per actualitzar el dial
        function updateDial(angle) {
            // Convertir angle a radians (amb 0° a la part superior)
            const radians = (angle - 90) * (Math.PI / 180);

            // Calcular nova posició del handle
            const x = center.x + radius * Math.cos(radians);
            const y = center.y + radius * Math.sin(radians);

            // Actualitzar posició visual
            orientationHandle.setAttribute("cx", x);
            orientationHandle.setAttribute("cy", y);
            orientationLine.setAttribute("x2", x);
            orientationLine.setAttribute("y2", y);

            // Arrodonir angle a múltiple de 5 per millor usabilitat
            const roundedAngle = Math.round(angle / 5) * 5;
            orientationDegreeDisplay.textContent = roundedAngle + "°";

            // Determinar direcció cardinal
            let cardinalKey = "sur"; // Valor per defecte
            for (const [key, range] of Object.entries(angleToCardinal)) {
                if (
                    (angle >= range.min ||
                        angle < (range.min === 315 ? 45 : range.max)) &&
                    (angle < range.max || range.max === 45)
                ) {
                    cardinalKey = key;
                    break;
                }
            }

            const cardinal = angleToCardinal[cardinalKey].label;
            orientationCardinalDisplay.textContent = cardinal;

            // Actualitzar camp ocult
            orientationHiddenInput.value = cardinalKey;

            // Guardar a localStorage (ara guardem tant l'angle com la direcció)
            const storageKeyAngle = window.userId
                ? `user_${window.userId}_orientacion`
                : "default_orientacio_angle";
            const storageKeyCardinal = window.userId
                ? `user_${window.userId}_orientacio_cardinal`
                : "default_orientacio_cardinal";

            localStorage.setItem(storageKeyAngle, angle.toString());
            localStorage.setItem(storageKeyCardinal, cardinalKey);
        }

        // Inicialitzar posició
        function initializeDial() {
            
            const storageKeyAngle = window.userId
                ? `user_${window.userId}_orientacion`
                : "default_orientacio_angle";
            const savedAngle = localStorage.getItem(storageKeyAngle);

            if (savedAngle !== null && !isNaN(savedAngle)) {
                // Utilitzar angle exacte guardat
                updateDial(parseFloat(savedAngle));
            } else {
                // Si no hi ha angle guardat, verificar si hi ha direcció cardinal
                const storageKeyCardinal = window.userId
                    ? `user_${window.userId}_orientacio_cardinal`
                    : "default_orientacio_cardinal";
                const savedCardinal = localStorage.getItem(storageKeyCardinal);

                if (savedCardinal && angleToCardinal[savedCardinal]) {
                    // Utilitzar valor cardinal guardat
                    updateDial(angleToCardinal[savedCardinal].value);
                } else if (
                    orientationHiddenInput.value &&
                    angleToCardinal[orientationHiddenInput.value]
                ) {
                    // Utilitzar valor de l'input ocult si existeix
                    updateDial(
                        angleToCardinal[orientationHiddenInput.value].value
                    );
                } else {
                    // Valor per defecte (Sud)
                    updateDial(180);
                }
            }
        }

        // Cridar a la inicialització
        initializeDial();

        // Resta del codi (event listeners, etc.) es manté igual
        let isDragging = false;

        orientationHandle.addEventListener("mousedown", startDrag);
        orientationSVG.addEventListener("mousemove", drag);
        document.addEventListener("mouseup", endDrag);

        // Suport tàctil
        orientationHandle.addEventListener("touchstart", startDrag);
        orientationSVG.addEventListener("touchmove", drag);
        document.addEventListener("touchend", endDrag);

        function startDrag(e) {
            e.preventDefault();
            isDragging = true;
        }

        function drag(e) {
            if (!isDragging) return;
            e.preventDefault();

            const coords = getSVGCoordinates(e, orientationSVG);
            const dx = coords.x - center.x;
            const dy = coords.y - center.y;
            let angle = Math.atan2(dy, dx) * (180 / Math.PI) + 90;
            if (angle < 0) angle += 360;

            updateDial(angle);
        }

        function endDrag() {
            isDragging = false;
        }

        function getSVGCoordinates(e, svgElement) {
            const pt = svgElement.createSVGPoint();
            if (e.type.includes("touch")) {
                const touch = e.touches[0];
                pt.x = touch.clientX;
                pt.y = touch.clientY;
            } else {
                pt.x = e.clientX;
                pt.y = e.clientY;
            }
            return pt.matrixTransform(svgElement.getScreenCTM().inverse());
        }
    }
});