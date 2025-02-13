<?php

namespace Src\Core;

/**
 * Classe Router pour gérer les routes et rediriger vers les bons contrôleurs.
 */
class Router
{
    // Tableau associatif contenant les routes définies
    private array $routes = [];

    /**
     * Ajoute une route à la liste des routes disponibles.
     *
     * @param string $path L'URI à associer à un contrôleur.
     * @param string $controller Le contrôleur à appeler.
     * @param string $method La méthode du contrôleur à exécuter (par défaut "index").
     */
    public function add(string $path, string $controller, string $method = "index"): void
    {
        $this->routes[$path] = ['controller' => $controller, 'method' => $method];
    }

    /**
     * Analyse l'URI et appelle le contrôleur et la méthode correspondants.
     *
     * @param string $uri L'URI demandée par l'utilisateur.
     */
    public function dispatch(string $uri): void
    {
        // Nettoyage de l'URI pour éviter les erreurs de formatage
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = trim($uri, '/');

        // Vérifie si l'URI correspond à une route enregistrée
        if (isset($this->routes[$uri])) {
            // Construction du nom du contrôleur en utilisant le namespace
            $controllerName = "Src\\Controllers\\" . $this->routes[$uri]['controller'];
            $method = $this->routes[$uri]['method'];

            // Vérifie si la classe du contrôleur existe
            if (class_exists($controllerName)) {
                $controller = new $controllerName();

                // Vérifie si la méthode demandée existe dans le contrôleur
                if (method_exists($controller, $method)) {
                    $controller->$method();
                } else {
                    echo "Erreur : La méthode '$method' n'existe pas dans le contrôleur $controllerName.";
                }
            } else {
                echo "Erreur : Le contrôleur '$controllerName' n'existe pas.";
            }
        } else {
            echo "404 - Page non trouvée.";
        }
    }
}
