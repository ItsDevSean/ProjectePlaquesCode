// Tabs functionality
const tabs = document.querySelectorAll('[data-tabs-target]');
const tabContents = document.querySelectorAll('[role="tabpanel"]');

tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        const target = document.querySelector(tab.dataset.tabsTarget);
        
        // Hide all tab contents
        tabContents.forEach(content => {
            content.classList.add('hidden');
        });
        
        // Show selected tab content
        target.classList.remove('hidden');
        
        // Update active tab styling
        tabs.forEach(t => {
            t.classList.remove('active', 'border-emerald-500', 'text-emerald-600', 'dark:text-emerald-400');
            t.classList.add('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300', 'dark:hover:text-gray-300');
        });
        
        tab.classList.add('active', 'border-emerald-500', 'text-emerald-600', 'dark:text-emerald-400');
        tab.classList.remove('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300', 'dark:hover:text-gray-300');
    });
});

// File upload functionality
const uploadBtn = document.getElementById('upload-btn');
const fileInput = document.getElementById('consumption-file');
const fileInfo = document.getElementById('file-info');
const fileName = document.getElementById('file-name');
const removeFile = document.getElementById('remove-file');
const fileProgress = document.getElementById('file-progress');

uploadBtn.addEventListener('click', () => fileInput.click());

fileInput.addEventListener('change', (e) => {
    if (e.target.files.length > 0) {
        const file = e.target.files[0];
        fileName.textContent = file.name;
        fileInfo.classList.remove('hidden');
        
        // Simulate file processing
        fileProgress.classList.remove('hidden');
        let progress = 0;
        const interval = setInterval(() => {
            progress += 10;
            fileProgress.querySelector('div').style.width = `${progress}%`;
            
            if (progress >= 100) {
                clearInterval(interval);
                fileProgress.querySelector('p').textContent = "Fitxer processat correctament";
                const sumbitButton = document.createElement('button');
                sumbitButton.id = "importButton";
                sumbitButton.type = 'submit';
                sumbitButton.innerHTML = 'Importar Fitxer';
                sumbitButton.classList.add('bg-[#49DBA3]', 'hover:bg-[#193849]', 'text-white', 'py-2', 'px-4', 'rounded-lg');
                const form = document.getElementById("electricBillForm");
                form.appendChild(sumbitButton);
                console.log("ifoahfoiaoif");
            }
        }, 200);
    }
});

removeFile.addEventListener('click', () => {
    fileInput.value = '';
    fileInfo.classList.add('hidden');
    fileProgress.classList.add('hidden');
});

// Initialize pattern charts
const initPatternChart = (ctx, data) => {
    return new Chart(ctx, {
        type: 'line',
        data: {
            labels: Array.from({length: 24}, (_, i) => i + ':00'),
            datasets: [{
                data: data,
                borderColor: '#10B981',
                borderWidth: 2,
                tension: 0.4,
                fill: false,
                pointRadius: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: false
                }
            },
            scales: {
                x: {
                    display: false
                },
                y: {
                    display: false
                }
            }
        }
    });
};

// Sample data for pattern charts
const diurnalData = [5,5,5,5,10,25,40,60,70,75,70,65,60,55,50,45,40,35,30,25,20,15,10,7];
const nocturnalData = [30,25,20,15,10,8,15,20,15,10,8,7,5,5,5,5,10,25,40,60,70,75,70,65];
const mixedData = [20,15,12,10,8,15,30,50,60,55,50,45,40,45,50,45,40,45,50,55,50,40,30,25];

// Initialize all pattern charts
const diurnalChart = initPatternChart(document.getElementById('diurnalPatternChart'), diurnalData);
const nocturnalChart = initPatternChart(document.getElementById('nocturnalPatternChart'), nocturnalData);
const mixedChart = initPatternChart(document.getElementById('mixedPatternChart'), mixedData);

// Pattern buttons functionality
const patternBtns = document.querySelectorAll('.consum-pattern-btn');
patternBtns.forEach(btn => {
    btn.addEventListener('click', function() {
        patternBtns.forEach(b => b.classList.remove('border-emerald-400', 'bg-emerald-50', 'dark:bg-emerald-900/30'));
        this.classList.add('border-emerald-400', 'bg-emerald-50', 'dark:bg-emerald-900/30');
        // Update main chart based on selected pattern
        updateMainChart();
    });
});

// Main consumption chart
const consumptionCtx = document.getElementById('consumptionChart').getContext('2d');
const consumptionChart = new Chart(consumptionCtx, {
    type: 'bar',
    data: {
        labels: ['Gen', 'Feb', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Oct', 'Nov', 'Des'],
        datasets: [
            {
                label: 'Consum actual',
                data: [320, 290, 280, 250, 230, 270, 310, 320, 290, 300, 320, 350],
                backgroundColor: '#10B981',
                borderRadius: 4
            },
            {
                label: 'Mitjana sectorial',
                data: [300, 280, 270, 260, 250, 260, 290, 300, 280, 290, 300, 320],
                backgroundColor: '#3B82F6',
                borderRadius: 4
            },
            {
                label: 'Consum ideal',
                data: [250, 240, 230, 220, 210, 220, 230, 240, 230, 240, 250, 270],
                backgroundColor: '#F59E0B',
                borderRadius: 4
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                mode: 'index',
                intersect: false,
                callbacks: {
                    label: function(context) {
                        return context.dataset.label + ': ' + context.raw + ' kWh';
                    }
                }
            }
        },
        scales: {
            x: {
                grid: {
                    display: false
                }
            },
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'kWh'
                }
            }
        }
    }
});

// Update chart based on period selection
document.getElementById('chart-period').addEventListener('change', function() {
    updateMainChart();
});

// Function that generates a dinamic form
function addForm() {
    let form = document.createElement('form');
    form.setAttribute('action', '{{ route("veureImport") }}');
    form.setAttribute('method', 'POST');
    form.setAttribute('enctype', 'multipart/form-data');
    let csrfInput = document.createElement('input');
    csrfInput.setAttribute('type', 'hidden');
    csrfInput.setAttribute('name', '_token');
    csrfInput.setAttribute('value', '{{ csrf_token() }}');  
    let button = document.createElement('button');
    button.setAttribute('type', 'submit');
    button.classList.add('bg-[#49DBA3]', 'hover:bg-[#193849]', 'text-white', 'py-2', 'px-4', 'rounded-lg');
    button.innerHTML = 'Importar';
    let errorDiv = document.createElement('div');
    errorDiv.classList.add('alert', 'alert-danger');
    form.appendChild(csrfInput);
    form.appendChild(button);
    form.appendChild(errorDiv);
    document.getElementById('container').appendChild(form);
}

function updateMainChart() {
    const period = document.getElementById('chart-period').value;
    let labels, actualData, averageData, idealData;
    
    switch(period) {
        case 'daily':
            labels = Array.from({length: 24}, (_, i) => i + ':00');
            actualData = Array.from({length: 24}, () => Math.floor(Math.random() * 10) + 5);
            averageData = Array.from({length: 24}, () => Math.floor(Math.random() * 8) + 4);
            idealData = Array.from({length: 24}, () => Math.floor(Math.random() * 6) + 3);
            break;
        case 'weekly':
            labels = ['Dl', 'Dt', 'Dc', 'Dj', 'Dv', 'Ds', 'Dg'];
            actualData = Array.from({length: 7}, () => Math.floor(Math.random() * 30) + 20);
            averageData = Array.from({length: 7}, () => Math.floor(Math.random() * 25) + 15);
            idealData = Array.from({length: 7}, () => Math.floor(Math.random() * 20) + 10);
            break;
        case 'monthly':
            labels = ['Gen', 'Feb', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Oct', 'Nov', 'Des'];
            actualData = [320, 290, 280, 250, 230, 270, 310, 320, 290, 300, 320, 350];
            averageData = [300, 280, 270, 260, 250, 260, 290, 300, 280, 290, 300, 320];
            idealData = [250, 240, 230, 220, 210, 220, 230, 240, 230, 240, 250, 270];
            break;
        case 'yearly':
            labels = ['2020', '2021', '2022', '2023'];
            actualData = [3600, 3700, 3550, 3450];
            averageData = [3500, 3600, 3500, 3400];
            idealData = [3000, 3100, 3000, 2900];
            break;
    }
    
    consumptionChart.data.labels = labels;
    consumptionChart.data.datasets[0].data = actualData;
    consumptionChart.data.datasets[1].data = averageData;
    consumptionChart.data.datasets[2].data = idealData;
    consumptionChart.update();
}

// Export chart functionality
document.getElementById('export-chart').addEventListener('click', function() {
    const link = document.createElement('a');
    link.download = 'consum-electric-' + document.getElementById('chart-period').value + '.png';
    link.href = document.getElementById('consumptionChart').toDataURL('image/png');
    link.click();
});

// Help modal
document.getElementById('help-button').addEventListener('click', function() {
    // Implement a modal with help information
    alert("Aquí s'obriria un modal amb informació d'ajuda sobre com introduir les dades de consum.");
});

// Añadir al final del script existente
document.getElementById('tarifa-acces').addEventListener('change', function() {
    const tarifa = this.value;
    const preciosContainer = document.getElementById('precios-periodo-container');
    
    // Mostrar precios por periodo solo para tarifas con discriminación horaria
    if (tarifa.includes('DHA') || tarifa.includes('DHS') || tarifa === '3.0A') {
        preciosContainer.classList.remove('hidden');
    } else {
        preciosContainer.classList.add('hidden');
    }
    
    // Actualizar etiquetas según tipo de tarifa
    if (tarifa === '3.0A') {
        document.querySelector('#precio-p1').placeholder = 'P1 (10-14h)';
        document.querySelector('#precio-p2').placeholder = 'P2 (14-18h)';
        document.querySelector('#precio-p3').placeholder = 'P3 (18-22h)';
    } else if (tarifa.includes('DHA') || tarifa.includes('DHS')) {
        document.querySelector('#precio-p1').placeholder = 'P1 (8-14h, 18-22h)';
        document.querySelector('#precio-p2').placeholder = 'P2 (14-18h, 22-24h)';
        document.querySelector('#precio-p3').placeholder = 'P3 (0-8h)';
    }
});

// Inicializar estado al cargar
document.addEventListener('DOMContentLoaded', function() {
    const event = new Event('change');
    document.getElementById('tarifa-acces').dispatchEvent(event);
});

function showCSV(data) {
    data.forEach(item => {
        console.log(`Year: ${item.year}, Month: ${item.month}, Consumption: ${item.consumption}, Cost: ${item.cost}`);
    }); //ToDo: see where it shows the error
}