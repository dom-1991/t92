<?php
namespace App\Repositories\Routes;

interface RoutesInterface{
	public function getRoutes(array $params);
	public function createRoute(array $params);
	public function updateRoute($id, array $params);
}