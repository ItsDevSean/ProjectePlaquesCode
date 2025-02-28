//Codigo js para el efecto parallax
document.addEventListener('DOMContentLoaded', function() {
    const parallaxImage = document.getElementById('parallaxImage');
    const parallaxContainer = parallaxImage.parentElement;
    
    window.addEventListener('scroll', function() {
        const rect = parallaxContainer.parentElement.getBoundingClientRect();
        
        if (rect.top < window.innerHeight && rect.bottom > 0) {
            const scrolled = window.pageYOffset;
            const speed = 0.8;
            const yPos = -(rect.top * speed);
            parallaxImage.style.transform = `translateY(${yPos}px)`;
        }
    });
});


//Codigo js para el efecto sumador de contadores
function iniciarContadores() {
    const contadores = document.querySelectorAll('.counter');
    
    function actualizarContador(contador) {
        const objetivo = parseInt(contador.getAttribute('data-target'));
        const valorActual = parseInt(contador.innerText) || 0;
        const incremento = Math.ceil(objetivo / 100);

        if (valorActual < objetivo) {
            contador.innerText = valorActual + incremento;
            setTimeout(() => actualizarContador(contador), 20);
        } else {
            contador.innerText = objetivo;
        }
    }

    const observador = new IntersectionObserver((elementos, observador) => {
        elementos.forEach(elemento => {
            if (elemento.isIntersecting) {
                actualizarContador(elemento.target);
                observador.unobserve(elemento.target);
            }
        });
    });

    contadores.forEach(contador => {
        contador.innerText = '0';
        observador.observe(contador);
    });
}

document.addEventListener('DOMContentLoaded', iniciarContadores);
