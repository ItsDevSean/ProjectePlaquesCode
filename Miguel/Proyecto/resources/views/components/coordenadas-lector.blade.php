<!-- Aqui generamos un div para poder observar lat y long -->
<div class="coordinates-display" id="coordinates">
    Latitud: <span id="lat">0.000000</span>, Longitud: <span id="lng">0.000000</span>
</div>

<!-- Y damos estilos -->
<style>
    .coordinates-display {
        position: absolute;
        bottom: 10px;
        left: 10px;
        background: rgba(255, 255, 255, 0.8);
        padding: 5px;
        border-radius: 3px;
        font-size: 14px;
    }
</style>