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
     * @return string Le contenu à afficher à l'utilisateur.
     */
    public function dispatch(string $uri): string
    {
        $uri = trim(parse_url($uri, PHP_URL_PATH), '/');

        if (isset($this->routes[$uri])) {
            $controllerName = "Src\\Controllers\\" . $this->routes[$uri]['controller'];
            $method = $this->routes[$uri]['method'];

            if (class_exists($controllerName)) {
                $controller = new $controllerName();

                if (method_exists($controller, $method)) {
                    return $controller->$method();
                } else {
                    return $this->handle404();
                }
            } else {
                return $this->handle404();
            }
        } else {
            return $this->handle404();
        }
    }

    /**
     * Gère les erreurs 404.
     *
     * @return string Le contenu à afficher à l'utilisateur.
     */
    private function handle404(): string
    {
        $errorController = new \Src\Controllers\Error404Controller();
        return $errorController->notFound();
    }
}
