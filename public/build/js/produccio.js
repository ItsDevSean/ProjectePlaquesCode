document.addEventListener('DOMContentLoaded', function() {
    const userId = window.userId;

    function calcularProduccionMensual() {
        // Obtener datos necesarios del localStorage
        const radiacionData = JSON.parse(localStorage.getItem(`user_${userId}_monthlyRadiation`)) || [];
        const placaCount = parseFloat(localStorage.getItem(`user_${userId}_placaCount`)) || 0;
        const potenciaMaxima = parseFloat(localStorage.getItem(`user_${userId}_panel_pot`)) || 0;
        
        // Verificar que tenemos todos los datos necesarios
        if (!radiacionData.length || placaCount <= 0 || potenciaMaxima <= 0) {
            console.error("Datos insuficientes en localStorage");
            return [];
        }
    
        // Calcular producción para cada mes
        const produccionMensual = radiacionData.map(item => {
            if (!item.radiation_kWh) return {
                month: item.month,
                produccion_kWh: 0,
                error: item.error || "Datos de radiación no disponibles"
            };
    
            const produccion = item.radiation_kWh * ((placaCount * potenciaMaxima) / 1000) * 0.8;
            
            return {
                month: item.month,
                produccion_kWh: parseFloat(produccion.toFixed(2)),
                radiacion_kWh: item.radiation_kWh
            };
        });
    
        // Guardar los resultados en localStorage
        localStorage.setItem(`user_${userId}_produccionMensual`, JSON.stringify(produccionMensual));
        return produccionMensual;
    }

    // Calcular producción mensual
    const produccionMensual = calcularProduccionMensual();
    
    // Obtener datos para mostrar
    const savedLocation = localStorage.getItem(`user_${userId}_direccion`) || "Ubicación no especificada";
    const tarifaAcces = localStorage.getItem(`user_${userId}_user_1_tarifa`) || "No especificada";
    const panel_model = localStorage.getItem(`user_${userId}_panel_model`) || "Modelo no especificado";
    const orientacion = localStorage.getItem(`user_${userId}_orientacion`) || "No especificada";
    const inclinacio = localStorage.getItem(`user_${userId}_inclinacion`) || "No especificada";
    const tipusInstalacio = localStorage.getItem(`user_${userId}_tipusInstalacion`) || "No especificada";
    const placaCount = parseFloat(localStorage.getItem(`user_${userId}_placaCount`)) || 0;
    const potenciaMaxima = parseFloat(localStorage.getItem(`user_${userId}_panel_pot`)) || 0;
    const radiacionAnual = parseFloat(localStorage.getItem(`user_${userId}_radiacion`)) || 0;
    const patroAutoconsum = localStorage.getItem(`user_${userId}_consumPattern`) || "No especificada";
    const consumAnual = localStorage.getItem(`user_${userId}_consumAnual`) || "No especificada";
    const facturaAnual =  localStorage.getItem(`user_${userId}_facturaAnual`) || "No especificada";
    const preuExcedents =  localStorage.getItem(`user_${userId}_precioExcedentes`) || "No especificada";
    const costInstalació = localStorage.getItem(`user_${userId}_costeInstalacion`) || "No especificada";
    const subvenciones = localStorage.getItem(`user_${userId}_subvenciones`) || "No especificada";

    // Calcular métricas importantes
    const prodAnual = radiacionAnual * ((placaCount * potenciaMaxima) / 1000) * 0.8;
    const equiLlar = prodAnual / 2500
    const horasAnuales = 8760;
    const factorCapacidad = (prodAnual / ((placaCount * potenciaMaxima / 1000) * horasAnuales) * 100).toFixed(1);
    const horasPico = radiacionAnual.toFixed(0);
    const potenciaInstalada = (placaCount * potenciaMaxima) / 1000; // Convertir a kWp
    const energiaTeorica = radiacionAnual * potenciaInstalada; 
    const energiaReal = radiacionAnual * potenciaInstalada * 0.8;
    const rendimiento = (energiaReal / energiaTeorica) * 100;
    console.log(equiLlar)
    

    // Calculs d'estalivi i impacte
    const genearcioSolar = potenciaInstalada * horasPico * rendimiento; 
    const autconsum = patroAutoconsum * genearcioSolar;
    const excedents = genearcioSolar - autconsum;
    const preuElectricitat = facturaAnual / consumAnual;
    const estalviAnual = (consumAnual * patroAutoconsum * preuElectricitat) + (excedents * preuExcedents) 
    const coEvitat = consumAnual * patroAutoconsum * 0.253
    const retornInversio = (costInstalació - subvenciones) / estalviAnual;

    // Actualizar la interfaz con los datos reales
    document.getElementById('systemEfficiency').textContent = rendimiento;
    document.getElementById('equivalentHomes').textContent = equiLlar.toFixed(1);
    document.getElementById('location').textContent = savedLocation;
    document.getElementById('panelCount').textContent = placaCount;
    document.getElementById('panelModel').textContent = panel_model;
    document.getElementById('orientation').textContent = orientacion;
    document.getElementById('tilt').textContent = inclinacio;
    document.getElementById('annualProduction').textContent = Math.round(prodAnual).toLocaleString();
    document.getElementById('capacityFactor').textContent = factorCapacidad;
    document.getElementById('peakSunHours').textContent = horasPico;
    document.getElementById('tarifaAcces').textContent = tarifaAcces;
    document.getElementById('tipusInstalacio').textContent = tipusInstalacio;
    document.getElementById('annualSavings').textContent = estalviAnual.toFixed(0);
    document.getElementById('co2Saved').textContent = coEvitat;
    document.getElementById('roiYears').textContent = retornInversio.toFixed(2);

    // Actualizar la tabla de datos mensuales con los datos reales
    const tableBody = document.getElementById('monthlyDataTable');
    tableBody.innerHTML = ''; // Limpiar tabla primero
    
    if (produccionMensual.length > 0) {
        produccionMensual.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${item.month}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${item.produccion_kWh.toLocaleString()}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${(item.produccion_kWh / (item.produccion_kWh / produccionMensual.length)).toFixed(0)}%</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${Math.round(item.produccion_kWh * 0.15).toLocaleString()}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${Math.round(item.produccion_kWh * 0.4).toLocaleString()}</td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Gráfico de producción mensual con datos reales
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    if (window.monthlyChartInstance) {
        window.monthlyChartInstance.destroy(); // Destruir instancia previa si existe
    }
    
    window.monthlyChartInstance = new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: produccionMensual.map(item => item.month.substring(0, 3)),
            datasets: [{
                label: 'Producció (kWh)',
                data: produccionMensual.map(item => item.produccion_kWh),
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

    // Gráfico de patrón diario (este sigue siendo de ejemplo ya que no tenemos datos reales)
    const dailyCtx = document.getElementById('dailyPatternChart').getContext('2d');
    if (window.dailyChartInstance) {
        window.dailyChartInstance.destroy();
    }
    
    window.dailyChartInstance = new Chart(dailyCtx, {
        type: 'line',
        data: {
            labels: Array.from({length: 24}, (_, i) => i + ':00'),
            datasets: [{
                label: 'Producció horària (W)',
                data: Array(24).fill().map((_, i) => {
                    // Simular un patrón diario básico (puedes ajustar esto)
                    if (i < 5 || i > 19) return 0;
                    return Math.sin((i-5)/14 * Math.PI) * 3000;
                }),
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

    // Actualizar anillo de progreso
    const circle = document.querySelector('.progress-ring__circle');
    if (circle) {
        const radius = circle.r.baseVal.value;
        const circumference = radius * 2 * Math.PI;
        prodAnualTotal = localStorage.getItem(`user_${userId}_radiacion`) * ((localStorage.getItem(`user_${userId}_maxPlacas`) * potenciaMaxima)/ 1000) * 0.8;
        const offset = circumference - (prodAnual / prodAnualTotal * circumference);
        circle.style.strokeDasharray = `${circumference} ${circumference}`;
        circle.style.strokeDashoffset = offset;
    }
});

// Manejo del acordeón
const accordionCard = document.querySelector('.accordion-card');
if (accordionCard) {
    accordionCard.addEventListener('click', function() {
        const content = this.querySelector('.accordion-content');
        const icon = this.querySelector('.accordion-icon');
        
        content.classList.toggle('active');
        content.classList.toggle('hidden');
        icon.classList.toggle('active');
    });
}


