document.addEventListener('DOMContentLoaded', function() {
    // Clase principal para gestionar la aplicación de consumo
    class ConsumptionApp {
        
        constructor() {
            this.userId = window.userId || null;
            this.initElements();
            this.initEventListeners();
            this.initPatternCharts();
            this.initMainChart();
            this.loadSavedData();
        }

        // Inicializar referencias a elementos del DOM
        initElements() {
            this.elements = {
                // Inputs
                consumAnual: document.getElementById('consum-anual'),
                facturaAnual: document.getElementById('factura-anual'),
                tarifaAcces: document.getElementById('tarifa-acces'),
                costeInstalacion: document.getElementById('coste-instalacion'),
                subvenciones: document.getElementById('subvenciones'),
                precioExcedentes: document.getElementById('precio-excedentes'),
                preciosPeriodoContainer: document.getElementById('precios-periodo-container'),
                precioP1: document.getElementById('precio-p1'),
                precioP2: document.getElementById('precio-p2'),
                precioP3: document.getElementById('precio-p3'),
                
                // Botones
                buttonDiurn: document.getElementById('button_diurn'),
                buttonNocturn: document.getElementById('button_nocturn'),
                buttonMixt: document.getElementById('button_mixt'),
                helpButton: document.getElementById('help-button'),
                uploadBtn: document.getElementById('upload-btn'),
                removeFile: document.getElementById('remove-file'),
                exportChart: document.getElementById('export-chart'),
                importButton: document.getElementById('importButton'),
                
                // Pestañas
                tabs: document.querySelectorAll('[data-tabs-target]'),
                tabContents: document.querySelectorAll('[role="tabpanel"]'),
                
                // Gráficos
                diurnalPatternChart: document.getElementById('diurnalPatternChart'),
                nocturnalPatternChart: document.getElementById('nocturnalPatternChart'),
                mixedPatternChart: document.getElementById('mixedPatternChart'),
                consumptionChart: document.getElementById('consumptionChart'),
                
                // Upload
                fileInput: document.getElementById('consumption-file'),
                fileInfo: document.getElementById('file-info'),
                fileName: document.getElementById('file-name'),
                fileProgress: document.getElementById('file-progress'),
                
                // Selectores
                chartPeriod: document.getElementById('chart-period'),
                energyProvider: document.getElementById('energy-provider'),
                cupsNumber: document.getElementById('cups-number')
            };
        }

        // Inicializar event listeners
        initEventListeners() {
            // Inputs
            this.elements.consumAnual.addEventListener('change', () => this.saveToLocalStorage(`user_${userId}_consumAnual`, this.elements.consumAnual.value));
            this.elements.facturaAnual.addEventListener('change', () => this.saveToLocalStorage(`user_${userId}_facturaAnual`, this.elements.facturaAnual.value));
            this.elements.costeInstalacion.addEventListener('change', () => this.saveToLocalStorage(`user_${userId}_costeInstalacion`, this.elements.costeInstalacion.value));
            this.elements.subvenciones.addEventListener('change', () => this.saveToLocalStorage(`user_${userId}_subvenciones`, this.elements.subvenciones.value));
            this.elements.precioExcedentes.addEventListener('change', () => this.saveToLocalStorage(`user_${userId}_precioExcedentes`, this.elements.precioExcedentes.value));
            
            // Tarifa de acceso
            this.elements.tarifaAcces.addEventListener('change', () => {
                const selectedOption = this.elements.tarifaAcces.options[this.elements.tarifaAcces.selectedIndex];
                this.saveToLocalStorage(`user_${userId}_tarifaAcces`, selectedOption.textContent.trim());
                this.togglePreciosPeriodo();
            });
            
            // Patrones de consumo
            this.elements.buttonDiurn.addEventListener('click', () => {
                this.setActivePattern('diurn');
                this.saveToLocalStorage(`user_${userId}_consumPattern`, 0.7);
            });
            this.elements.buttonNocturn.addEventListener('click', () => {
                this.setActivePattern('nocturn');
                this.saveToLocalStorage(`user_${userId}_consumPattern`, 0.3);
            });
            this.elements.buttonMixt.addEventListener('click', () => {
                this.setActivePattern('mixt');
                this.saveToLocalStorage(`user_${userId}_consumPattern`, 0.5);
            });

            this.elements.importButton.addEventListener('click', () => {    
                console.log("maaaarc");
                let billAmount = 0;
                data.forEach(item => {
                    let cost = parseFloat(item["Bill Amount ($)"]);
                    billAmount += cost;
                });
                console.log("De todo: " + billAmount);
                this.saveToLocalStorage(`user_${this.userId}_factura-anual`, billAmount);
                console.log("dani se levanta " + localStorage.getItem("user_${userId}_factura-anual"));
            });
            
            // Pestañas
            this.elements.tabs.forEach(tab => {
                tab.addEventListener('click', () => this.switchTab(tab));
            });
            
            // Upload de archivo
            this.elements.uploadBtn.addEventListener('click', () => this.elements.fileInput.click());
            this.elements.fileInput.addEventListener('change', (e) => this.handleFileUpload(e));
            this.elements.removeFile.addEventListener('click', () => this.removeUploadedFile());
            
            // Gráfico principal
            this.elements.chartPeriod.addEventListener('change', () => this.updateMainChart());
            this.elements.exportChart.addEventListener('click', () => this.exportChart());
            
            // Ayuda
            this.elements.helpButton.addEventListener('click', () => this.showHelp());            
        }

        // Inicializar gráficos de patrones
        initPatternCharts() {
            // Datos de ejemplo para los patrones
            const diurnalData = [5,5,5,5,10,25,40,60,70,75,70,65,60,55,50,45,40,35,30,25,20,15,10,7];
            const nocturnalData = [30,25,20,15,10,8,15,20,15,10,8,7,5,5,5,5,10,25,40,60,70,75,70,65];
            const mixedData = [20,15,12,10,8,15,30,50,60,55,50,45,40,45,50,45,40,45,50,55,50,40,30,25];
            
            this.patternCharts = {
                diurn: this.createPatternChart(this.elements.diurnalPatternChart, diurnalData),
                nocturn: this.createPatternChart(this.elements.nocturnalPatternChart, nocturnalData),
                mixt: this.createPatternChart(this.elements.mixedPatternChart, mixedData)
            };
        }

        // Crear gráfico de patrón
        createPatternChart(ctx, data) {
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
                        legend: { display: false },
                        tooltip: { enabled: false }
                    },
                    scales: {
                        x: { display: false },
                        y: { display: false }
                    }
                }
            });
        }

        // Inicializar gráfico principal
        initMainChart() {
            this.consumptionChart = new Chart(this.elements.consumptionChart.getContext('2d'), {
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
                        legend: { display: false },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            callbacks: {
                                label: (context) => `${context.dataset.label}: ${context.raw} kWh`
                            }
                        }
                    },
                    scales: {
                        x: { grid: { display: false } },
                        y: {
                            beginAtZero: true,
                            title: { display: true, text: 'kWh' }
                        }
                    }
                }
            });
        }

        // Cargar datos guardados
        loadSavedData() {
            if (localStorage.getItem('consumAnual')) this.elements.consumAnual.value = localStorage.getItem('consumAnual');
            if (localStorage.getItem('facturaAnual')) this.elements.facturaAnual.value = localStorage.getItem('facturaAnual');
            if (localStorage.getItem('costeInstalacion')) this.elements.costeInstalacion.value = localStorage.getItem('costeInstalacion');
            if (localStorage.getItem('subvenciones')) this.elements.subvenciones.value = localStorage.getItem('subvenciones');
            if (localStorage.getItem('precioExcedentes')) this.elements.precioExcedentes.value = localStorage.getItem('precioExcedentes');
            
            // Cargar patrón de consumo
            if (localStorage.getItem('consumPattern')) {
                this.setActivePattern(localStorage.getItem('consumPattern'));
            } else {
                this.setActivePattern('mixt'); // Valor por defecto
            }
            
            // Disparar evento change para tarifa de acceso para inicializar precios por periodo
            this.elements.tarifaAcces.dispatchEvent(new Event('change'));
        }

        // Guardar en localStorage
        saveToLocalStorage(key, value) {
            localStorage.setItem(key, value);
        }

        // Mostrar/ocultar precios por periodo según tarifa
        togglePreciosPeriodo() {
            const tarifa = this.elements.tarifaAcces.value;
            
            if (tarifa.includes('DHA') || tarifa.includes('DHS') || tarifa === '3.0A') {
                this.elements.preciosPeriodoContainer.classList.remove('hidden');
                
                // Actualizar placeholders según tarifa
                if (tarifa === '3.0A') {
                    this.elements.precioP1.placeholder = 'P1 (10-14h)';
                    this.elements.precioP2.placeholder = 'P2 (14-18h)';
                    this.elements.precioP3.placeholder = 'P3 (18-22h)';
                } else if (tarifa.includes('DHA') || tarifa.includes('DHS')) {
                    this.elements.precioP1.placeholder = 'P1 (8-14h, 18-22h)';
                    this.elements.precioP2.placeholder = 'P2 (14-18h, 22-24h)';
                    this.elements.precioP3.placeholder = 'P3 (0-8h)';
                }
            } else {
                this.elements.preciosPeriodoContainer.classList.add('hidden');
            }
        }

        // Establecer patrón de consumo activo
        setActivePattern(pattern) {
            // Remover clases activas de todos los botones
            [this.elements.buttonDiurn, this.elements.buttonNocturn, this.elements.buttonMixt].forEach(btn => {
                btn.classList.remove('border-emerald-400', 'bg-emerald-50', 'dark:bg-emerald-900/30');
            });
            
            // Añadir clases al botón activo
            switch(pattern) {
                case 'diurn':
                    this.elements.buttonDiurn.classList.add('border-emerald-400', 'bg-emerald-50', 'dark:bg-emerald-900/30');
                    break;
                case 'nocturn':
                    this.elements.buttonNocturn.classList.add('border-emerald-400', 'bg-emerald-50', 'dark:bg-emerald-900/30');
                    break;
                case 'mixt':
                    this.elements.buttonMixt.classList.add('border-emerald-400', 'bg-emerald-50', 'dark:bg-emerald-900/30');
                    break;
            }
            
            // Actualizar gráfico principal según patrón seleccionado
            this.updateMainChart();
        }

        // Cambiar entre pestañas
        switchTab(activeTab) {
            const target = document.querySelector(activeTab.dataset.tabsTarget);
            
            // Ocultar todos los contenidos
            this.elements.tabContents.forEach(content => {
                content.classList.add('hidden');
            });
            
            // Mostrar contenido seleccionado
            target.classList.remove('hidden');
            
            // Actualizar estilos de las pestañas
            this.elements.tabs.forEach(tab => {
                tab.classList.remove('active', 'border-emerald-500', 'text-emerald-600', 'dark:text-emerald-400');
                tab.classList.add('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300', 'dark:hover:text-gray-300');
            });
            
            activeTab.classList.add('active', 'border-emerald-500', 'text-emerald-600', 'dark:text-emerald-400');
            activeTab.classList.remove('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300', 'dark:hover:text-gray-300');
        }

        // Manejar subida de archivo
        handleFileUpload(e) {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                this.elements.fileName.textContent = file.name;
                this.elements.fileInfo.classList.remove('hidden');
                
                // Simular procesamiento de archivo
                this.simulateFileProcessing();
            }
        }

        // Simular procesamiento de archivo
        simulateFileProcessing() {
            this.elements.fileProgress.classList.remove('hidden');
            let progress = 0;
            const progressBar = this.elements.fileProgress.querySelector('div');
            const progressText = this.elements.fileProgress.querySelector('p');
            
            const interval = setInterval(() => {
                progress += 10;
                progressBar.style.width = `${progress}%`;
                
                if (progress >= 100) {
                    clearInterval(interval);
                    progressText.textContent = "Fitxer processat correctament";
                    
                    // Aquí iría el código real para procesar el archivo CSV/Excel
                    // y actualizar los datos del gráfico
                }
            }, 200);
        }

        // Eliminar archivo subido
        removeUploadedFile() {
            this.elements.fileInput.value = '';
            this.elements.fileInfo.classList.add('hidden');
            this.elements.fileProgress.classList.add('hidden');
        }

        // Actualizar gráfico principal según periodo seleccionado
        updateMainChart() {
            const period = this.elements.chartPeriod.value;
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
            
            this.consumptionChart.data.labels = labels;
            this.consumptionChart.data.datasets[0].data = actualData;
            this.consumptionChart.data.datasets[1].data = averageData;
            this.consumptionChart.data.datasets[2].data = idealData;
            this.consumptionChart.update();
        }

        // Exportar gráfico como imagen
        exportChart() {
            const link = document.createElement('a');
            link.download = `consum-electric-${this.elements.chartPeriod.value}.png`;
            link.href = this.elements.consumptionChart.toDataURL('image/png');
            link.click();
        }

        // Mostrar ayuda
        showHelp() {
            alert("Aquí s'obriria un modal amb informació d'ajuda sobre com introduir les dades de consum.");
        }
    }

    // Inicializar la aplicación
    new ConsumptionApp();
});