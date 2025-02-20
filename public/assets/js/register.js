document.addEventListener("DOMContentLoaded", () => {
    console.log("register.js chargé");

    const registerForm = document.getElementById("registerForm");

    if (!registerForm) {
        console.error("registerForm introuvable !");
        return;
    }

    console.log("registerForm détecté :", registerForm);

    registerForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Empêche l'envoi du formulaire si erreur
        let isValid = true;

        // Sélection des champs
        const username = document.querySelector("#register-username");
        const email = document.querySelector("#register-email");
        const password = document.querySelector("#register-password");
        const confirmPassword = document.querySelector("#register-confirm_password");
        const terms = document.querySelector("#terms");

        // Fonction pour afficher une erreur sous le champ
        function showError(input, message) {
            input.classList.add("input-error");
            let errorText = input.nextElementSibling;

            if (!errorText || !errorText.classList.contains("error-text")) {
                errorText = document.createElement("span");
                errorText.classList.add("error-text");
                errorText.style.color = "red";
                errorText.style.fontSize = "0.9rem";
                errorText.textContent = message;
                input.parentNode.appendChild(errorText);
            }
        }

        // Fonction pour retirer une erreur
        function clearError(input) {
            input.classList.remove("input-error");
            let errorText = input.nextElementSibling;
            if (errorText && errorText.classList.contains("error-text")) {
                errorText.remove();
            }
        }

        // Vérification du nom d'utilisateur
        if (username.value.trim() === "") {
            showError(username, "Le nom d'utilisateur est requis.");
            isValid = false;
        } else {
            clearError(username);
        }

        // Vérification de l'email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email.value)) {
            showError(email, "L'email n'est pas valide.");
            isValid = false;
        } else {
            clearError(email);
        }

        // Vérification du mot de passe
        if (password.value !== confirmPassword.value) {
            showError(confirmPassword, "Les mots de passe ne correspondent pas.");
            isValid = false;
        } else {
            clearError(confirmPassword);
        }

        // Vérification des conditions générales
        if (!terms.checked) {
            showError(terms, "Vous devez accepter les conditions générales.");
            isValid = false;
        } else {
            clearError(terms);
        }

        // Si tout est bon, soumettre le formulaire
        if (isValid) {
            console.log("Formulaire valide, soumission...");
            registerForm.submit();
        }
    });
});
