document.querySelectorAll('.estado-select').forEach(select => {
    setColor(select); // Aplicar el color inicial
});

function setColor(select) {
    const selectedOption = select.options[select.selectedIndex];
    const color = selectedOption.dataset.color;

    // Actualizar el color del texto del <select>
    select.style.color = color === 'completado' ? 'red' : color === 'iniciado' ? 'green' : 'orange';

    // Actualizar el color de las opciones
    Array.from(select.options).forEach(option => {
        const optionColor = option.dataset.color;
        option.style.color = optionColor === 'completado' ? 'red' : optionColor === 'iniciado' ? 'green' : 'orange';
    });
}