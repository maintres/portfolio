<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Audiometría</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <!-- Primero agregamos el CSS de Bootstrap Icons en el head -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Estilos CSS -->
    <style>
        /* Estilos para la tabla de referencias */
        .table-bordered {
            margin-top: 20px;
        }
        .table-bordered th,
        .table-bordered td {
            text-align: center;
            vertical-align: middle;
            padding: 8px;
        }
        /* Asegurar que la tabla de referencias se mantenga visible */
        @media (max-width: 768px) {
            .col-md-3 {
                margin-top: 20px;
            }
        }
        /* Estilos del contenedor del audiograma */
        .audiogram-wrapper {
            width: 100%;
            overflow-x: hidden;
            -webkit-overflow-scrolling: touch;
        }
        
        .audiogram-container {
            width: 100%;
            min-width: 900px;
            margin: 0 auto;
        }
        
        @media (max-width: 1400px) {
            .audiogram-wrapper {
                overflow-x: auto;
            }
        }
        
        .svg-audiogram {
            background: white;
            /* border: 0.5px solid rgba(0, 0, 0, 0.17); */
            display: block;
            width: 100%;
            height: auto;
        }
        
        .grid-line {
            stroke: rgba(0, 0, 0, 0.45);
            stroke-width: 1;
        }
        .grid-line.highlighted {
            stroke: rgba(128, 128, 128, 0.3);
            stroke-width: 1;
        }
        /* Unificación de líneas gruesas negras */
        .grid-line.freq-1000,
        .grid-line.db-zero,
        .grid-line.db-twenty,
        .grid-line.db-minus-ten,
        .axis-line {
            stroke: black;
            stroke-width: 2;
        }
        .highlighted-area {
            fill: rgba(0, 0, 0, 0.22);
            stroke: none;
        }
        .axis-line {
            stroke: black;
            stroke-width: 2;
        }
        .axis-label {
            font-size: 15px;
            font-family: Arial;
        }

        /* Estilos de los puntos y líneas */
        .point-rightAir, .point-leftAir {
            fill: none;
            stroke-width: 3 !important;;
        }
        .point-rightAir, .point-rightBone {
            stroke: red;
        }
        .point-leftAir, .point-leftBone {
            stroke: blue;
        }
        .point-rightBone, .point-leftBone {
            font-weight: bold !important;
            stroke-width: 0.1!important;
        }
        .point-rightBone {
            fill: red;
            stroke: red;
            font-weight: bold;
        }
        .point-leftBone {
            fill: blue;
            stroke: blue;
            font-weight: bold;
        }

        /* Estilos de las líneas de conexión */
        .line-rightAir, .line-leftAir{
            stroke-width: 2;
            fill: none;
        }
        .line-rightAir{
            stroke: red;
        }
        .line-leftAir{
            stroke: blue;
        }

        /* Estilos de referencias */
        .reference-item {
            display: inline-block;
            margin-right: 20px;
            font-size: 140px;
        }

        /* Estilos de la tabla y botones */
        td, th {
            padding: 2px !important;
            vertical-align: middle !important;
            text-align: center !important;
        }
        .table {
            max-width: 250px !important;
        }
        .btn-symbol {
            min-width: 30px;
            padding: 0px 4px;
            height: 28px; /* Reducida de 38px */
            line-height: 1;
            margin: 0;
            border-radius: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-undo {
            height: 28px; /* Reducida de 38px */
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0px 4px;
        }
        .symbol-triangle-right,
        .symbol-triangle-left{
            font-family: 'MS Gothic';
            font-weight: bold !important;
        }

        .symbol-circle, 
        .symbol-x,
        .symbol-triangle-right,
        .symbol-triangle-left {
            font-size: 20px; /* Reducido de 20px */
            display: block;
            text-align: center;
            width: 100%;
            
            
        }
    </style>
</head>
<body class="bg-secondary">
    <div class="container pt-3 bg-white">
        <h5 class="text-center mb-4">Sistema de Audiometría</h5>
        
        <!-- Formulario de datos del paciente -->
        <div class="card mb-2">
            <div class="card-header">
                <h5>Datos del Paciente</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <label for="patientName" class="form-label">Nombre del Paciente</label>
                        <input type="text" class="form-control" id="patientName" placeholder="Ingrese el nombre">
                    </div>
                    <div class="col-md-3">
                        <label for="patientDNI" class="form-label">DNI</label>
                        <input type="text" class="form-control" id="patientDNI" placeholder="Ingrese el DNI">
                    </div>
                    <div class="col-md-3">
                        <label for="obraSocial" class="form-label">Obra Social</label>
                        <input type="text" class="form-control" id="obraSocial" placeholder="Ingrese la obra social">
                    </div>
                    <div class="col-md-3">
                        <label for="testDate" class="form-label">Fecha del Examen</label>
                        <input type="date" class="form-control" id="testDate">
                    </div>
                </div>
            </div>
        </div>

        <!-- Audiograma -->
        <div class="card mb-2">
            <div class="card-header">
                <h5>Audiograma - Audiometría Tonal</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <!-- Contenedor del audiograma -->
                        <div class="audiogram-wrapper">
                            <div class="audiogram-container">
                                <svg class="svg-audiogram" width="1000" height="500" id="audiogramSVG"></svg>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-center justify-content-center">
                        <!-- Referencias -->
                        <table class="table table-bordered mb-0 border-2" style="max-width: 300px; margin: 0 auto; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                            <thead class="bg-light">
                                <tr style="line-height: 1;">
                                    <th style="padding: 8px !important; background-color: #f8f9fa; color: #495057; font-size: 0.95rem;">Vía</th>
                                    <th style="padding: 8px !important; background-color: #f8f9fa; color: #495057; font-size: 0.95rem;">Derecha</th>
                                    <th style="padding: 8px !important; background-color: #f8f9fa; color: #495057; font-size: 0.95rem;">Izquierda</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="line-height: 1;">
                                    <td style="padding: 8px !important; font-weight: 600; color: #495057;">Aérea</td>
                                    <td style="padding: 8px !important;">
                                        <input type="radio" class="btn-check" name="audiogram-type" id="rightAir" autocomplete="off" checked>
                                        <label class="btn btn-outline-danger btn-symbol w-100 py-1 rounded-3" for="rightAir">
                                            <span class="symbol-circle" style="font-size: 1.1rem;">O</span>
                                        </label>
                                    </td>
                                    <td style="padding: 8px !important;">
                                        <input type="radio" class="btn-check" name="audiogram-type" id="leftAir" autocomplete="off">
                                        <label class="btn btn-outline-primary btn-symbol w-100 py-1 rounded-3" for="leftAir">
                                            <span class="symbol-x" style="font-size: 1.1rem;">X</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr style="line-height: 1;">
                                    <td style="padding: 8px !important; font-weight: 600; color: #495057;">Ósea</td>
                                    <td style="padding: 8px !important;">
                                        <input type="radio" class="btn-check" name="audiogram-type" id="rightBone" autocomplete="off">
                                        <label class="btn btn-outline-danger btn-symbol w-100 py-1 rounded-3" for="rightBone">
                                            <span class="symbol-triangle-right" style="font-size: 1.1rem;"><</span>
                                        </label>
                                    </td>
                                    <td style="padding: 8px !important;">
                                        <input type="radio" class="btn-check" name="audiogram-type" id="leftBone" autocomplete="off">
                                        <label class="btn btn-outline-primary btn-symbol w-100 py-1 rounded-3" for="leftBone">
                                            <span class="symbol-triangle-left" style="font-size: 1.1rem;">></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr style="line-height: 1;">
                                    <td colspan="3" style="padding: 8px !important;">
                                        <button class="btn btn-warning btn-undo py-1 w-100 rounded-3" onclick="undoLastAction()" 
                                            style="background: linear-gradient(145deg, #ffd000, #ffb300); border: none; box-shadow: 0 2px 4px rgba(0,0,0,0.2); color: #000;">
                                            <i class="bi bi-arrow-counterclockwise me-1"></i>Deshacer
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>                    
                </div>
            </div>
        </div>

        <!-- Card de Diagnóstico separado -->
        <div class="card mb-3">
            <div class="card-header">
                <h5>Diagnóstico</h5>
            </div>
            <div class="card-body">
                <textarea class="form-control" id="diagnostico" rows="4" placeholder="Ingrese el diagnóstico"></textarea>
            </div>
        </div>

        <!-- Botones de exportación -->
        
        <div class="text-center mb-1 pb-4">     
            <button class="btn btn-danger me-2" onclick="exportToPDF()" id="pdfBtn">
                <i class="bi bi-file-earmark-pdf-fill me-1"></i> Exportar a PDF
            </button>
            <button class="btn btn-info" onclick="exportToImage()" id="imgBtn">
                <i class="bi bi-file-earmark-image-fill me-1"></i> Exportar Imagen
            </button>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Configuración inicial
        const frequencies = [0, 125, 250, 500, 1000, 2000, 3000, 4000, 6000, 8000,9000];
        const decibels = [-10, 0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120, 130];
        let currentType = 'rightAir';
        const points = {
            rightAir: [],
            leftAir: [],
            rightBone: [],
            leftBone: []
        };

        // Agregar event listeners para los botones de radio
        document.querySelectorAll('input[name="audiogram-type"]').forEach(radio => {
            radio.addEventListener('change', function() {
                currentType = this.id;
            });
        });

        const svg = document.getElementById('audiogramSVG');
        const margin = { top: 55, right: 25, bottom: 10, left: 60 };
        const height = svg.clientHeight - margin.top - margin.bottom;
        const width = svg.clientWidth - margin.left - margin.right;

        // Asegurarse de que solo se cree una cuadrícula al inicio
        window.addEventListener('DOMContentLoaded', function() {
            clearAudiogram(); // Limpiar cualquier contenido previo
            createGrid();    // Crear la cuadrícula una sola vez
        });
        // Funciones del audiograma
        function createGrid() {
            // Crear grupo principal
            const g = document.createElementNS("http://www.w3.org/2000/svg", "g");
            g.setAttribute("transform", `translate(${margin.left},${margin.top})`);
            svg.appendChild(g);

            // Agregar área sombreada para 0-20 dB
            const areaHeight = (height * 2) / (decibels.length - 1); // Altura para 0-20 dB (2 intervalos)
            const highlightedArea = document.createElementNS("http://www.w3.org/2000/svg", "rect");
            highlightedArea.setAttribute("x", 0);
            highlightedArea.setAttribute("y", (height * 1) / (decibels.length - 1)); // Comienza en 0 dB
            highlightedArea.setAttribute("width", width);
            highlightedArea.setAttribute("height", areaHeight);
            highlightedArea.setAttribute("class", "highlighted-area");
            g.appendChild(highlightedArea);

            // Líneas horizontales y etiquetas de dB (modificado para espaciado reducido)
            decibels.forEach((db, i) => {
                
                const y = (i * height) / (decibels.length - 1);  // Eliminar multiplicador 0.7
                
                // Línea horizontal
                const line = document.createElementNS("http://www.w3.org/2000/svg", "line");
                line.setAttribute("x1", 0);
                line.setAttribute("x2", width);
                line.setAttribute("y1", y);
                line.setAttribute("y2", y);
                // Agregar clase especial para las líneas de 0 y 20 dB
                let lineClass = "grid-line";
                if (db === 0) lineClass += " db-zero";
                if (db === 20) lineClass += " db-twenty";
                if (db === -10) lineClass += " db-minus-ten";
                line.setAttribute("class", lineClass);
                g.appendChild(line);

                // Etiqueta dB
                const text = document.createElementNS("http://www.w3.org/2000/svg", "text");
                text.setAttribute("x", -10);
                text.setAttribute("y", y);
                text.setAttribute("text-anchor", "end");
                text.setAttribute("alignment-baseline", "middle");
                text.setAttribute("class", "axis-label");
                text.textContent = db === -10 || db === 130 ? '' : (db >= 1 ? `${db/1}` : db);
                g.appendChild(text);
            });

            // Líneas verticales y etiquetas de frecuencia
            frequencies.forEach((freq, i) => {           
                let x;
                if (freq === 125) {
                    x = (i * width * 0.236) / 4;
                } else if (freq === 250) {
                    x = (i * width * 0.411) / 4;  
                } else if (freq === 500) {
                    x = (i * width * 0.469) / 4;
                } else if (freq === 1000 ) {
                    x = (i * width * 0.500) / 4;
                }else if (freq === 2000 ) {
                    x = (i * width * 0.517) / 4;
                }else if (freq === 3000 ) {
                    x = (i * width * 0.480) / 4;
                }else if (freq === 4000) {
                    x = (i * width * 0.453) / 4;
                }else if (freq === 6000) {
                    x = (i * width * 0.433) / 4;
                } else if (freq === 8000) {
                    x = (i * width * 0.417) / 4;
                }else if (freq === 9000) {
                    x = (i * width * 0.40) / 4;
                }
                // Línea vertical
                const line = document.createElementNS("http://www.w3.org/2000/svg", "line");
                line.setAttribute("x1", x);
                line.setAttribute("x2", x);
                line.setAttribute("y1", 0);
                line.setAttribute("y2", height);
                line.setAttribute("class", `grid-line ${freq === 1000 || freq === 9000 ? 'freq-1000' : ''}`);
                g.appendChild(line);

                // Etiqueta frecuencia
                const text = document.createElementNS("http://www.w3.org/2000/svg", "text");
                text.setAttribute("x", x);
                text.setAttribute("y", -10);
                text.setAttribute("text-anchor", "middle");
                text.setAttribute("class", "axis-label");
                text.textContent = freq === 0 || freq === 9000 ? '' : (freq >= 1 ? `${freq/1}` : freq);
                g.appendChild(text);
            });

            // Ejes
            const xAxis = document.createElementNS("http://www.w3.org/2000/svg", "line");
            xAxis.setAttribute("x1", 0);
            xAxis.setAttribute("x2", width);
            xAxis.setAttribute("y1", height);
            xAxis.setAttribute("y2", height);
            xAxis.setAttribute("class", "axis-line");
            g.appendChild(xAxis);

            const yAxis = document.createElementNS("http://www.w3.org/2000/svg", "line");
            yAxis.setAttribute("x1", 0);
            yAxis.setAttribute("x2", 0);
            yAxis.setAttribute("y1", 0);
            yAxis.setAttribute("y2", height);
            yAxis.setAttribute("class", "axis-line");
            g.appendChild(yAxis);

            // Etiqueta eje Y (izquierda)
            const yLabel = document.createElementNS("http://www.w3.org/2000/svg", "text");
            yLabel.setAttribute("x", -30);
            yLabel.setAttribute("y", height -215);
            yLabel.setAttribute("text-anchor", "middle");
            yLabel.setAttribute("transform", "rotate(-90,-30," + (height/2) + ")");
            yLabel.setAttribute("class", "axis-label");
            yLabel.textContent = "Intensidad dB HL";
            g.appendChild(yLabel);

            // Etiqueta eje X (abajo)
            const xLabel = document.createElementNS("http://www.w3.org/2000/svg", "text");
            xLabel.setAttribute("x", width/2);
            xLabel.setAttribute("y", -36);
            xLabel.setAttribute("text-anchor", "middle");
            xLabel.setAttribute("class", "axis-label");
            xLabel.textContent = "Frecuencia (Hz)";
            g.appendChild(xLabel);
        }

        function setCurrentType(type) {
            currentType = type;
            document.querySelectorAll('.btn-group .btn').forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelector(`button[onclick="setCurrentType('${type}')"]`).classList.add('active');
        }

        function getSymbolPath(type) {
            switch(type) {
                case 'rightAir': return 'M -9,0 A 9,9 0 1,1 9,0 A 9,9 0 1,1 -9,0';  // Círculo más grande
                case 'leftAir': return 'M -10,-10 L 10,10 M -10,10 L 10,-10';  // X más grande
            }
        }

        function drawLines() {
            // Eliminar solo líneas de vías aéreas
            svg.querySelectorAll('.line-rightAir, .line-leftAir').forEach(line => line.remove());

            // Solo conectar puntos de vías aéreas
            ['rightAir', 'leftAir'].forEach(type => {
                const typePoints = points[type];
                if (typePoints.length > 1) {
                    const sortedPoints = [...typePoints].sort((a, b) => a.x - b.x);
                    
                    const pathData = `M ${sortedPoints[0].x + margin.left} ${sortedPoints[0].y + margin.top} ` +
                        sortedPoints.slice(1).map(p => `L ${p.x + margin.left} ${p.y + margin.top}`).join(' ');

                    const path = document.createElementNS("http://www.w3.org/2000/svg", "path");
                    path.setAttribute("d", pathData);
                    path.setAttribute("class", `line-${type}`);
                    svg.appendChild(path);
                }
            });
        }

        let actionHistory = [];

        function addPoint(event) {
            const rect = svg.getBoundingClientRect();
            const x = event.clientX - rect.left - margin.left;
            const y = event.clientY - rect.top - margin.top;
        
            if (x >= 0 && x <= width && y >= 0 && y <= height) {
                // Guardar el estado actual antes de agregar el punto
                const currentState = {
                    type: currentType,
                    points: JSON.parse(JSON.stringify(points))
                };
                actionHistory.push(currentState);
                
                if (currentType === 'rightBone' || currentType === 'leftBone') {
                    const text = document.createElementNS("http://www.w3.org/2000/svg", "text");
                    text.setAttribute("x", x + margin.left);
                    text.setAttribute("y", y + margin.top);
                    text.setAttribute("text-anchor", "middle");
                    text.setAttribute("alignment-baseline", "middle");
                    text.setAttribute("class", `point-${currentType}`);
                    text.setAttribute("font-size", "50");
                    text.setAttribute("font-family", "MS Gothic");
                    text.textContent = currentType === 'rightBone' ? '<' : '>';
                    svg.appendChild(text);
                } else {
                    // Mantener la implementación original para vías aéreas
                    const point = document.createElementNS("http://www.w3.org/2000/svg", "path");
                    point.setAttribute("d", getSymbolPath(currentType));
                    point.setAttribute("class", `point-${currentType}`);
                    point.setAttribute("transform", `translate(${x + margin.left},${y + margin.top})`);
                    svg.appendChild(point);
                }
        
                points[currentType].push({x, y});
                drawLines();
            }
        }

        function clearAudiogram() {
            // Eliminar TODOS los elementos del SVG, incluyendo la cuadrícula y puntos
            while (svg.firstChild) {
                svg.removeChild(svg.firstChild);
            }
        }

        function redrawAllPoints() {
            // Redibujar todos los puntos
            Object.entries(points).forEach(([type, typePoints]) => {
                typePoints.forEach(point => {
                    if (type === 'rightAir' || type === 'leftAir') {
                        const symbol = document.createElementNS("http://www.w3.org/2000/svg", "path");
                        symbol.setAttribute("d", getSymbolPath(type));
                        symbol.setAttribute("class", `point-${type}`);
                        symbol.setAttribute("transform", `translate(${point.x + margin.left},${point.y + margin.top})`);
                        svg.appendChild(symbol);
                    } else {
                        // Para puntos óseos
                        const text = document.createElementNS("http://www.w3.org/2000/svg", "text");
                        text.setAttribute("class", `point-${type}`);
                        text.setAttribute("x", point.x + margin.left);
                        text.setAttribute("y", point.y + margin.top);
                        text.textContent = type === 'rightBone' ? '<' : '>';
                        svg.appendChild(text);
                    }
                });
            });
            // Redibujar las líneas de conexión
            drawLines();
        }

        function undoLastAction() {
            if (actionHistory.length > 0) {
                // Obtener el último estado guardado
                const lastState = actionHistory.pop();
                
                // Restaurar el estado de los puntos
                points.rightAir = [...lastState.points.rightAir];
                points.leftAir = [...lastState.points.leftAir];
                points.rightBone = [...lastState.points.rightBone];
                points.leftBone = [...lastState.points.leftBone];
                
                // Limpiar completamente el SVG
                clearAudiogram();
                
                // Recrear la cuadrícula desde cero
                createGrid();
                
                // Redibujar todos los puntos y líneas
                redrawAllPoints();
            }
        }

        function redrawAllPoints() {
            Object.keys(points).forEach(type => {
                points[type].forEach(point => {
                    if (type === 'rightBone' || type === 'leftBone') {
                        const text = document.createElementNS("http://www.w3.org/2000/svg", "text");
                        text.setAttribute("x", point.x + margin.left);
                        text.setAttribute("y", point.y + margin.top);
                        text.setAttribute("text-anchor", "middle");
                        text.setAttribute("alignment-baseline", "middle");
                        text.setAttribute("class", `point-${type}`);
                        text.setAttribute("font-size", "50");
                        text.setAttribute("font-family", "MS Gothic");
                        text.textContent = type === 'rightBone' ? '<' : '>';
                        svg.appendChild(text);
                    } else {
                        const pointElement = document.createElementNS("http://www.w3.org/2000/svg", "path");
                        pointElement.setAttribute("d", getSymbolPath(type));
                        pointElement.setAttribute("class", `point-${type}`);
                        pointElement.setAttribute("transform", `translate(${point.x + margin.left},${point.y + margin.top})`);
                        svg.appendChild(pointElement);
                    }
                });
            });
            drawLines();
        }

        function drawLines() {
            // Eliminar solo líneas de vías aéreas
            svg.querySelectorAll('.line-rightAir, .line-leftAir').forEach(line => line.remove());

            // Solo conectar puntos de vías aéreas
            ['rightAir', 'leftAir'].forEach(type => {
                const typePoints = points[type];
                if (typePoints.length > 1) {
                    const sortedPoints = [...typePoints].sort((a, b) => a.x - b.x);
                    
                    const pathData = `M ${sortedPoints[0].x + margin.left} ${sortedPoints[0].y + margin.top} ` +
                        sortedPoints.slice(1).map(p => `L ${p.x + margin.left} ${p.y + margin.top}`).join(' ');

                    const path = document.createElementNS("http://www.w3.org/2000/svg", "path");
                    path.setAttribute("d", pathData);
                    path.setAttribute("class", `line-${type}`);
                    svg.appendChild(path);
                }
            });
        }
     
        function formatDate(dateString) {
            if(!dateString) return '';
            const date = new Date(dateString);
            return date.toLocaleDateString('es-ES');
        }
        // Inicializar
        createGrid();
        svg.addEventListener('click', addPoint);
        document.getElementById('testDate').valueAsDate = new Date();

        // Función de exportación
        function exportToPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF('p', 'mm', 'a4');
            const pageWidth = doc.internal.pageSize.getWidth();
            
            // Configuración inicial
            doc.setFontSize(16);
            doc.text('AUDIOGRAMA - AUDIOMETRÍA TONAL', pageWidth/2, 15, { align: 'center' });
            
            // Datos del paciente
            doc.setFontSize(11);            
            doc.rect(15, 20, 180, 25);//recuadro datos del paciente(x,y,ancho,alto)y=posicion vertical
            // Configurar fuente en negrita para las etiquetas
            doc.setFont("helvetica", "bold");
            doc.text('Nombre:', 20, 27);
            doc.text('Obra Social:', 20, 35);
            doc.text('DNI:', 20, 42);
            doc.text('Fecha:', 120, 42);
            
            // Configurar fuente normal para los valores
            doc.setFont("helvetica", "normal");
            doc.text(`${document.getElementById('patientName').value}`, 38, 27);
            doc.text(`${document.getElementById('obraSocial').value}`, 44, 35);
            doc.text(`${document.getElementById('patientDNI').value}`, 30, 42);
            doc.text(`${document.getElementById('testDate').value}`, 135, 42);
            // Restaurar fuente normal
            doc.setFont("helvetica", "normal");

            // Capturar el audiograma y referencias
            const container = document.createElement('div');
            container.style.width = '1100px';
            container.style.backgroundColor = 'white';
            container.style.padding = '0px';
            
            // Clonar el audiograma y las referencias
            const audiogramClone = document.querySelector('.audiogram-container').cloneNode(true);
            const referencesClone = createReferencesTable();
            
            // Organizar el contenido en una fila
            container.style.display = 'flex';
            container.appendChild(audiogramClone);
            container.appendChild(referencesClone);
            document.body.appendChild(container);

            html2canvas(container, {
                scale: 2,
                backgroundColor: '#ffffff'
            }).then(canvas => {
                // Agregar la imagen del audiograma con referencias
                const imgData = canvas.toDataURL('image/png');
                const imgWidth = 180;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                doc.addImage(imgData, 'PNG', 20, 50, imgWidth, imgHeight);//50 altura del grafico
                
                // Agregar el diagnóstico
                const diagnostico = document.getElementById('diagnostico').value;
                const startY = 47 + imgHeight + 10;// Cambiado de 75 a 65 para mover más arriba
                
                doc.setFontSize(12);
                doc.text('DIAGNÓSTICO:', 20, startY);
                doc.setFontSize(10);
                const splitDiagnostico = doc.splitTextToSize(diagnostico, pageWidth - 40);
                doc.text(splitDiagnostico, 20, startY + 10);
                
                // Eliminar el contenedor temporal
                document.body.removeChild(container);
                
                // Guardar el PDF
                doc.save('Informe_Audiometria.pdf');
            });
        }

        function exportToImage() {
            // Crear contenedor para el informe completo
            const container = document.createElement('div');
            container.style.width = '1200px';
            container.style.backgroundColor = 'white';
            container.style.padding = '40px';
            
            // Título
            const title = document.createElement('h3');
            title.style.textAlign = 'center';
            title.style.marginBottom = '20px';
            title.textContent = 'AUDIOGRAMA - AUDIOMETRÍA TONAL';
            container.appendChild(title);
            
            // Datos del paciente
            const patientData = document.createElement('div');
            patientData.style.marginBottom = '30px';
            patientData.innerHTML = `
                <div style="border: 1px solid black; padding: 10px; margin: 10px 0;font-size: 20px;">
                    <p><strong>Nombre:</strong> ${document.getElementById('patientName').value}</p>
                    <p><strong>Obra Social:</strong> ${document.getElementById('obraSocial').value}</p>
                    <p><strong>DNI:</strong> ${document.getElementById('patientDNI').value} <span style="margin: 0 50px;"></span> <strong>Fecha:</strong> ${document.getElementById('testDate').value}</p>
                </div>
            `;
            container.appendChild(patientData);
            
            // Contenedor para audiograma y referencias
            const audiogramContainer = document.createElement('div');
            audiogramContainer.style.display = 'flex';
            audiogramContainer.style.justifyContent = 'center';
            audiogramContainer.style.gap = '5px';
            audiogramContainer.style.marginBottom = '20px';
            
            // Clonar el audiograma y las referencias
            const audiogramClone = document.querySelector('.audiogram-container').cloneNode(true);
            const referencesClone = createReferencesTable();
            
            audiogramContainer.appendChild(audiogramClone);
            audiogramContainer.appendChild(referencesClone);
            container.appendChild(audiogramContainer);
            
            // Diagnóstico
            const diagnosticoTitle = document.createElement('h3');
            diagnosticoTitle.textContent = 'DIAGNÓSTICO:';
            container.appendChild(diagnosticoTitle);
            
            const diagnosticoText = document.createElement('p');
            diagnosticoText.textContent = document.getElementById('diagnostico').value;
            container.appendChild(diagnosticoText);
            
            // Agregar el contenedor al documento temporalmente
            document.body.appendChild(container);
            
            // Convertir a imagen
            html2canvas(container, {
                scale: 2,
                backgroundColor: '#ffffff'
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = 'Informe_Audiometria.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
                
                // Eliminar el contenedor temporal
                document.body.removeChild(container);
            });
        }
        

        // Función auxiliar para crear la tabla de referencias
        function createReferencesTable() {
            const table = document.createElement('table');
            table.style.borderCollapse = 'collapse';
            table.style.marginLeft = '0px';
            table.style.height = 'fit-content';
            table.style.marginTop = '150px'; // Ajusta la posición vertical
            table.innerHTML = `
                <tr style="height: 20px;">
                    <th style="border: 1px solid black; padding: 1px; font-size: 14px;">Vía</th>
                    <th style="border: 1px solid black; padding: 1px; font-size: 14px;">Derecha</th>
                    <th style="border: 1px solid black; padding: 1px; font-size: 14px;">Izquierda</th>
                </tr>
                <tr style="height: 20px;">
                    <td style="border: 1px solid black; padding: 1px; font-size: 14px;font-weight: bold;">Aérea</td>
                    <td style="border: 1px solid black; padding: 1px;"><div style="color: red; font-size: 16px;">O</div></td>
                    <td style="border: 1px solid black; padding: 1px;"><div style="color: blue; font-size: 16px;">X</div></td>
                </tr>
                <tr style="height: 20px;">
                    <td style="border: 1px solid black; padding: 1px; font-size: 14px;font-weight: bold;">Ósea</td>
                    <td style="border: 1px solid black; padding: 1px;"><div style="color: red; font-size: 16px; font-family: MS Gothic;font-weight: bold;">&lt;</div></td>
                    <td style="border: 1px solid black; padding: 1px;"><div style="color: blue; font-size: 16px; font-family: MS Gothic;font-weight: bold;">&gt;</div></td>
                </tr>
            `;
            return table;
        }

        // Inicializar el grid del audiograma
        createGrid();
    </script>
</body>
</html>