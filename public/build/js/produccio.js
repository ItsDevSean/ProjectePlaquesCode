// Dades d'exemple (a la implementació real vindrien de la teva API)
const productionData = {
    location: "Barcelona, ES",
    tarifaAcces: "2.0A",
    panelCount: 12,
    panelModel: "Trina Solar Vertex S 450W",
    tipusInstalacio: "Monofàsica",
    orientation: "Sud",
    tilt: "30°",
    annualProduction: 4320,
    equivalentHomes: 1.2,
    annualSavings: 648,
    co2Saved: 1728,
    roiYears: 5.2,
    capacityFactor: "18.2",
    peakSunHours: 1598,
    systemEfficiency: "78.5",
    monthlyProduction: [220, 240, 320, 380, 420, 450, 480, 460, 390, 340, 260, 230],
    dailyPattern: [0, 0, 0, 0, 10, 50, 120, 200, 250, 280, 300, 320, 330, 320, 300, 250, 180, 90, 20, 0, 0, 0, 0, 0],
    monthlyDetails: [
        { month: "Gener", production: 220, performance: "75%", savings: 33, co2: 88 },
        { month: "Febrer", production: 240, performance: "82%", savings: 36, co2: 96 },
        { month: "Març", production: 320, performance: "85%", savings: 48, co2: 128 },
        { month: "Abril", production: 380, performance: "88%", savings: 57, co2: 152 },
        { month: "Maig", production: 420, performance: "90%", savings: 63, co2: 168 },
        { month: "Juny", production: 450, performance: "92%", savings: 68, co2: 180 },
        { month: "Juliol", production: 480, performance: "95%", savings: 72, co2: 192 },
        { month: "Agost", production: 460, performance: "93%", savings: 69, co2: 184 },
        { month: "Setembre", production: 390, performance: "89%", savings: 59, co2: 156 },
        { month: "Octubre", production: 340, performance: "86%", savings: 51, co2: 136 },
        { month: "Novembre", production: 260, performance: "80%", savings: 39, co2: 104 },
        { month: "Desembre", production: 230, performance: "77%", savings: 35, co2: 92 }
    ]
};

// Carregar dades quan el DOM estigui llest
document.addEventListener('DOMContentLoaded', function() {
    const savedLocation = localStorage.getItem('direccion');
    const tarifaAcces = localStorage.getItem('user_1_tarifa');
    const panel_model = localStorage.getItem('panel_model');
    const orientacion = localStorage.getItem('orientacion');
    const inclinacio = localStorage.getItem('inclinacion');
    const tipusInstalacio = localStorage.getItem('tipusInstalacion');
    const placaCount = localStorage.getItem('placaCount');
    const potenciaMaxima = localStorage.getItem('panel_pot');
    const prodAnualString = localStorage.getItem('radiacion') * ((localStorage.getItem('placaCount') * potenciaMaxima)/ 1000) * 0.8;
    const radiacionAnual= parseFloat(localStorage.getItem('radiacion'));
    const prodAnual = prodAnualString.toFixed();
    const horasAnuales = 8760;
    const factorCapacidad = (prodAnual / ((placaCount * potenciaMaxima / 1000) * horasAnuales) * 100).toFixed(1);
    const horasPico = (radiacionAnual).toFixed(0);
    console.log(localStorage);
    const superficieSistema = localStorage.getItem('superficie') * placaCount;
    console.log(localStorage.getItem('superficie'));
    const rendimentSistema = (prodAnual / (radiacionAnual * superficieSistema)) * 100;
    console.log(rendimentSistema);
    document.getElementById('systemEfficiency').textContent = (rendimentSistema).toFixed(2);
    
    document.getElementById('location').textContent = savedLocation;
    document.getElementById('panelCount').textContent = placaCount;
    document.getElementById('panelModel').textContent = panel_model;
    document.getElementById('orientation').textContent = orientacion;
    document.getElementById('tilt').textContent = inclinacio;
    document.getElementById('annualProduction').textContent = prodAnual.toLocaleString();
    document.getElementById('equivalentHomes').textContent = productionData.equivalentHomes;
    document.getElementById('annualSavings').textContent = productionData.annualSavings;
    document.getElementById('co2Saved').textContent = productionData.co2Saved.toLocaleString();
    document.getElementById('roiYears').textContent = productionData.roiYears;
    document.getElementById('capacityFactor').textContent = factorCapacidad;
    document.getElementById('peakSunHours').textContent = horasPico;
    document.getElementById('tarifaAcces').textContent = tarifaAcces;
    document.getElementById('tipusInstalacio').textContent = tipusInstalacio;

    // Taula de dades mensuals
    const tableBody = document.getElementById('monthlyDataTable');
    productionData.monthlyDetails.forEach(month => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${month.month}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${month.production.toLocaleString()}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${month.performance}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${month.savings.toLocaleString()}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${month.co2.toLocaleString()}</td>
        `;
        tableBody.appendChild(row);
    });

    // Gràfic de producció mensual
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: ['Gen', 'Feb', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Oct', 'Nov', 'Des'],
            datasets: [{
                label: 'Producció (kWh)',
                data: productionData.monthlyProduction,
                backgroundColor: '#49DBA3',
                borderColor: '#3ACF92',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'kWh'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Gràfic de patró diari
    const dailyCtx = document.getElementById('dailyPatternChart').getContext('2d');
    new Chart(dailyCtx, {
        type: 'line',
        data: {
            labels: Array.from({length: 24}, (_, i) => i + ':00'),
            datasets: [{
                label: 'Producció horària (W)',
                data: productionData.dailyPattern,
                backgroundColor: 'rgba(73, 219, 163, 0.1)',
                borderColor: '#49DBA3',
                borderWidth: 2,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Watts'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Hora del dia'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Actualitzar anell de progrés
    const circle = document.querySelector('.progress-ring__circle');
    const radius = circle.r.baseVal.value;
    const circumference = radius * 2 * Math.PI;
    prodAnualTotal = localStorage.getItem('radiacion') * ((localStorage.getItem('maxPlacas') * potenciaMaxima)/ 1000) * 0.8;
    console.log(prodAnual)
    const offset = circumference - (prodAnualString / prodAnualTotal * circumference);
    circle.style.strokeDasharray = `${circumference} ${circumference}`;
    circle.style.strokeDashoffset = offset;


});

const accordionCard = document.querySelector('.accordion-card');
    
    accordionCard.addEventListener('click', function() {
        const content = this.querySelector('.accordion-content');
        const icon = this.querySelector('.accordion-icon');
        
        content.classList.toggle('active');
        content.classList.toggle('hidden'); // Por si usas Tailwind
        icon.classList.toggle('active');
    });