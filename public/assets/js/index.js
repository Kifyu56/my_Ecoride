document.addEventListener("DOMContentLoaded", () => {
    console.log("JavaScript chargé !");

    // Fonction pour ouvrir un modal
    function openModal(id) {
        console.log("Ouverture du modal:", id);
        const modal = document.getElementById(id);
        if (modal) {
            modal.style.display = "flex";
        }
    }

    // Fonction pour fermer un modal
    function closeModal(id) {
        console.log("Fermeture du modal:", id);
        const modal = document.getElementById(id);
        if (modal) {
            modal.style.display = "none";
        }
    }

    // Ouvrir un modal quand on clique sur un bouton
    document.querySelectorAll("[data-open-modal]").forEach(button => {
        console.log("Bouton détecté :", button);
        button.addEventListener("click", event => {
            event.preventDefault();
            console.log("Clic détecté sur :", button.dataset.openModal);
            const modalId = button.getAttribute("data-open-modal");
            openModal(modalId);
        });
    });

    // Fermer un modal quand on clique sur le bouton de fermeture
    document.querySelectorAll(".close").forEach(button => {
        button.addEventListener("click", function() {
            const modalId = this.getAttribute("data-modal");;
            closeModal(modalId);
        });
    });

    // Fermer le modal en cliquant en dehors
    window.addEventListener("click", event => {
        document.querySelectorAll(".modal").forEach(modal => {
            if (event.target === modal) {
                closeModal(modal.id);
            }
        });
    });
});
