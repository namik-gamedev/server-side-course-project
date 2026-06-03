<?php
class Router
{
    private $routes = [];
    private $notFoundCallback;

    public function addRoute($method, $pattern, $callback)
    {
        $method = strtoupper($method);
        $this->routes[] = [
            'method' => $method,
            'pattern' => $pattern,
            'callback' => $callback
        ];
    }

    public function setNotFound($callback)
    {
        $this->notFoundCallback = $callback;
    }

    public function dispatch($requestMethod, $requestUri)
    {
        $requestMethod = strtoupper($requestMethod);
        $uri = parse_url($requestUri, PHP_URL_PATH);

        foreach ($this->routes as $route) {
            if ($route['method'] !== $requestMethod) {
                continue;
            }

            // Преобразуем паттерн типа /article/{id} в регулярное выражение
            $pattern = '#^' . preg_replace('/\{([a-z]+)\}/', '(?P<$1>[^/]+)', $route['pattern']) . '$#';
            if (preg_match($pattern, $uri, $matches)) {
                // Убираем числовые ключи
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                call_user_func($route['callback'], $params);
                return;
            }
        }

        if ($this->notFoundCallback) {
            call_user_func($this->notFoundCallback);
        } else {
            http_response_code(404);
            echo "404 Not Found";
        }
    }
}