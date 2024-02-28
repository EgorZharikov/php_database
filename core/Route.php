<?php

namespace App\Core;

class Route
{
	public function start()
	{
		// контроллер и действие по умолчанию
		$controller_name = 'main';
		$action_name = 'index';
		$routes = $_SERVER['REQUEST_URI'];
		$routes = ltrim($routes, '/');
		$routes = strtok($routes,'?');
		$routes = explode('/', $routes);

		// получаем имя контроллера
		if (isset($routes[1]) and $routes[0] !== '' ) {
			$controller_name = $routes[0];
		}
		// получаем метод контроллера
		if (isset($routes[1])) {
			$action_name = $routes[1];
		}
		// добавляем префиксы
		$model_name = 'model_' . $controller_name;
		$controller_name = 'controller_' . $controller_name;
		$action_name = 'action_' . $action_name;
		// подцепляем файл с классом модели (файла модели может и не быть)
		$model_file = strtolower($model_name) . '.php';
		$model_path = APP_PATH . "/app/Models/" . $model_file;
		if (file_exists($model_path)) {
			include APP_PATH . "/app/Models/" . $model_file;
		}
		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name) . '.php';
		$controller_path = APP_PATH . "/app/Controllers/" . $controller_file;
		if (file_exists($controller_path)) {
			include APP_PATH . "/app/Controllers/" . $controller_file;
		} else {

			Route::ErrorPage404();
		}
		// создаем контроллер
		$controller = new $controller_name;
		$action = $action_name;

		if (method_exists($controller, $action)) {
			// вызываем действие контроллера
			$controller->$action();
		} else {

			Route::ErrorPage404();
		}
	}
	public static function ErrorPage404()
	{
		$host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
		header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:' . $host . '404');
		exit;
	}
}
