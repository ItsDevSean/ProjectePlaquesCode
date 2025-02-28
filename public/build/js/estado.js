document.querySelectorAll('.estado-select').forEach(select => {
    setColor(select);
});

function setColor(select) {
    const selectedOption = select.options[select.selectedIndex];
    const color = selectedOption.dataset.color;

    select.classList.remove('text-red-500', 'text-green-500', 'text-orange-500');

    if (color === 'completado') {
        select.classList.add('text-red-500');
    } else if (color === 'iniciado') {
        select.classList.add('text-green-500');
    } else if (color === 'pendiente') {
        select.classList.add('text-orange-500');
    }

    Array.from(select.options).forEach(option => {
        const optionColor = option.dataset.color;
        option.classList.remove('text-red-500', 'text-green-500', 'text-orange-500');
        if (optionColor === 'completado') {
            option.classList.add('text-red-500');
        } else if (optionColor === 'iniciado') {
            option.classList.add('text-green-500');
        } else if (optionColor === 'pendiente') {
            option.classList.add('text-orange-500');
        }
    });
}