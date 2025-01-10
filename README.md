# EcoRide - Plateforme de covoiturage alternatif et écologique

EcoRide est une application web innovante dédiée au covoiturage, avec une approche unique qui privilégie des moyens de locomotion réellement écologiques. Contrairement aux plateformes classiques, EcoRide valorise des solutions comme le partage de véhicules tirés par des chevaux ou d'autres modes de transport à faible empreinte environnementale, tout en sensibilisant les utilisateurs à des choix véritablement durables. De plus, je met tout en oeuvre pour avoir un calcul avec des criteres bien spécifiques qui permettra de savoir qu'elle véhicules est réellement écologique(poids, années de construction, bilan carbone totale construction + consomation, ...)

---

## Table des matières
- [À propos](#à-propos)
- [Fonctionnalités](#fonctionnalités)
- [Technologies utilisées](#technologies-utilisées)
- [Structure du projet](#structure-du-projet)
- [Configuration de l'environnement](#configuration-de-lenvironnement)
- [Pipeline CI/CD](#pipeline-ci-cd)
- [Contact](#contact)

---

## À propos
EcoRide repense le covoiturage en mettant en avant des solutions de transport réellement écologiques et accessibles. Avec une plateforme éducative et engageante, EcoRide souhaite sensibiliser les utilisateurs à des alternatives de transport respectueuses de l’environnement tout en favorisant les échanges humains.

---

## Fonctionnalités
- Recherche de covoiturages par ville et date.
- Filtrage avancé par prix, durée, note du conducteur, et type de locomotion.
- Page de sensibilisation à l’écologie avec données dynamiques.
- Création de compte pour les utilisateurs (chauffeur et/ou passager).
- Espace administrateur pour gérer les utilisateurs et consulter les rapports.
- Intégration de graphiques pour visualiser les impacts écologiques des trajets.
- Gestion des moyens de transport alternatifs (chevaux, vélos partagés, etc.).

---

## Technologies utilisées

- **Frontend** :
  - HTML5, CSS3 (Bootstrap), JavaScript.

- **Backend** :
  - PHP avec PDO.

- **Base de données relationnelle** :
  - MySQL.

- **Base de données NoSQL** :
  - MongoDB.

- **CI/CD** : 
  - GitHub Actions.

- **Versionning** : 
  - Git.

- **Outils de gestion** :
  - Trello : Gestion de projet.
  - Figma : Création de maquettes.
  - Draw.io : Schémas et diagrammes.
  - Toggl Track : Suivi du temps.

---

## Structure du projet
```
/public         # Fichiers accessibles publiquement (index.php)
   /assets         # Ressources statiques (CSS, images, JS)
/src
   /controllers # Contrôleurs (logique de traitement)
   /models      # Modèles (connexion à la base de données)
   /views       # Vues (fichiers pour l'affichage)

```
Cette structure évoluera au fur et à mesure du développement.

---

## Configuration de l'environnement

### En local
1. **Installation** :
   - Téléchargez et installez [XAMPP](https://www.apachefriends.org/index.html) ou un serveur local similaire.
   - Assurez-vous que MySQL est activé.
2. **Clonez le dépôt** :
   ```bash
   git clone https://github.com/Kifyu56/my_Ecoride.git
   ```
3. **Importer la base de données** :
   - Utilisez le fichier `database.sql` pour initialiser la base de données en local via phpMyAdmin ou un outil similaire.
4. **Configurer le fichier `.env`** :
   - Dans le dossier racine du projet, crée un fichier `.env` :
     ```
     DB_HOST=localhost
     DB_NAME=ecoride
     DB_USER=root
     DB_PASS=
     ```

---

## Pipeline CI/CD
Le projet utilise GitHub Actions pour automatiser les tâches suivantes :
- Tests unitaires et fonctionnels sur la branche `dev`.
- Construction et déploiement de l’application sur PlanetHoster à partir de la branche `main`.

### Workflow Git

1. **Types de branches** : 
J'utilise une convention de nommage pour mieux structurer mon travail :

   - feature/usXX-nom : Pour le développement d'une nouvelle fonctionnalité (User Story).
   - fix/nom-du-bug : Pour corriger un bug identifié.
   - improvement/nom-de-l-amélioration : Pour améliorer une fonctionnalité existante.
   - hotfix/nom-du-probleme : Pour corriger rapidement un problème en production.
   - test/nom-du-test : Pour expérimenter ou créer des tests.
1. **Développement** :
   - Chaque branche est fusionné dans la branche `dev` après validation.
2. **Production** :
   - Une fois les tests validés sur `dev`, fusion dans `main` pour le déploiement automatique.


---

## Contact
Pour toute question ou suggestion, contactez-moi à [webmaster@kifyudevland.bzh](mailto:webmaster@kifyudevland.bzh).
