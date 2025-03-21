    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById("modal");
        const openModalBtn = document.getElementById("openModal");
        const closeModalBtn = document.getElementById("closeModal");
        const closeModalByButton = document.getElementById("closeModalBtn");
        const imagenInput = document.getElementById("imagen_inversor");
        const previewImg = document.getElementById("preview");

        openModalBtn.addEventListener("click", () => modal.classList.remove("hidden"));
        closeModalBtn.addEventListener("click", () => modal.classList.add("hidden"));
        closeModalByButton.addEventListener("click", () => modal.classList.add("hidden"));

        imagenInput.addEventListener("change", function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImg.src = event.target.result;
                    previewImg.classList.remove("hidden");
                };
                reader.readAsDataURL(file);
            }
        });
    });

