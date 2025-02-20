document.addEventListener("DOMContentLoaded", () => {
    console.log("modals.js est chargé");

    // Fonction pour ouvrir une modal
    function openModal(id) {
        console.log("Ouverture du modal:", id);
        closeAllModals();
        const modal = document.getElementById(id);
        if (modal) {
            modal.style.display = "flex";
        }
    }

    // Fonction pour fermer une modal
    function closeModal(id) {
        console.log("Fermeture du modal:", id);
        const modal = document.getElementById(id);
        if (modal) {
            modal.style.display = "none";
        }
    }

    // Fermer toutes les modals avant d'en ouvrir une autre
    function closeAllModals() {
        document.querySelectorAll(".modal").forEach(modal => {
            modal.style.display = "none";
        });
    }

    // Ouvrir une modal quand on clique sur un bouton
    document.querySelectorAll("[data-open-modal]").forEach(button => {
        console.log("Bouton détecté :", button);
        button.addEventListener("click", event => {
            event.preventDefault();
            console.log("Clic détecté sur :", button.dataset.openModal);
            openModal(button.dataset.openModal);
        });
    });

    // Fermer une modal quand on clique sur le bouton de fermeture
    document.querySelectorAll(".close").forEach(button => {
        button.addEventListener("click", function () {
            const modal = this.closest(".modal");
            if (modal) {
                closeModal(modal.id);
            }
        });
    });

    // Fermer la modal en cliquant en dehors
    window.addEventListener("click", event => {
        document.querySelectorAll(".modal").forEach(modal => {
            if (event.target === modal) {
                closeModal(modal.id);
            }
        });
    });
});
