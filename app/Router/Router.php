<?php

namespace App\Router;

class Router
{
    private $routes = [];

    // Ajoutez une méthode pour enregistrer des routes
    public function route($pattern, $action) {
        // Ajoutez des délimiteurs (par exemple, des barres obliques) autour du motif.
        $pattern = '/' . str_replace('/', '\/', $pattern) . '/';
    
        // Enregistrez la route dans le tableau des routes
        $this->routes[$pattern] = $action;
    }
    
    // Ajoutez une méthode pour résoudre une URL
    public function resolve($url)
    {
        foreach ($this->routes as $pattern => $action) {
            // Utilisez preg_match pour vérifier si l'URL correspond au modèle de route
            if (preg_match($pattern, $url, $matches)) {
                // Appeler l'action correspondante en passant les correspondances en tant qu'arguments
                array_shift($matches); // Retirez le premier élément qui correspond à l'URL complète
                call_user_func_array($action, $matches);
                return;
            }
        }

        // Si aucune route ne correspond, vous pouvez gérer cela ici (par exemple, afficher une page 404)
        echo "Debug: No route matched for URL: $url"; // Debug statement
        echo "Page not found";
    }
}
