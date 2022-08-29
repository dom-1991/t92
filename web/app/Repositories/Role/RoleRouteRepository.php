<?php

namespace App\Repositories\Role;
use App\Repositories\Role\RoleRouteInterface;
use App\Repositories\EloquentRepository;
use DB;

class RoleRouteRepository extends EloquentRepository implements RoleRouteInterface{

	const ROLES = 'roles';
	const ROUTES = 'routes';
	const ROLE_ROUTE = 'role_route';

	public function getDB(){
		return DB::table(self::ROLE_ROUTE);
	}

	public function getRoleRoute($params){
		return $this->_model->where(function($query) use($params){
            if(isset($params['id'])){
                $query->where('id', $params['id']);
            }
            if(isset($params['role_id'])){
                $query->where('role_id', $params['role_id']);
            }
            if(isset($params['route_id'])){
                $query->where('route_id', $params['route_id']);
            }
        })->get();
	}

	public function validateRoleRoute(array $params){
		if(isset($params['role_id'])){
			$result = DB::table(self::ROLES)->where('id', $params['role_id'])->get();
			if(count($result) <= 0){
				return response()->json([
					'error' => \App\Message\Message::ERROR_CODE_FAIL,
					'message' => \App\Message\Message::ID_ROLE_NOT_FOUND
				], \App\Message\Message::ERROR_CODE_400);
			}
		}
		if(isset($params['route_id'])){
			$result = DB::table(self::ROUTES)->where('id', $params['route_id'])->get();
			if(count($result) <= 0){
				return response()->json([
					'error' => \App\Message\Message::ERROR_CODE_FAIL,
					'message' => \App\Message\Message::ID_ROUTE_NOT_FOUND
				], \App\Message\Message::ERROR_CODE_400);
			}
		}

		$result = DB::table(self::ROLE_ROUTE)
		->where('role_id', $params['role_id'])
		->where('route_id', $params['route_id'])
		->get();

		if(count($result) >= 1){
			return response()->json([
				'error' => \App\Message\Message::ERROR_CODE_FAIL,
				'message' => \App\Message\Message::ROLE_ROUTE_EXIST
			]);
		}

		return response()->json([
			'error' => 0,
			'message' => \App\Message\Message::ROLE_ROUTE_VALID
		], 200);
	}

	public function store(array $params){
		$result = $this->validateRoleRoute($params);
		if(json_decode(json_encode($result))->original->error > 0 ){
			return response()->json([
				'error' => 1,
				'message' => json_decode(json_encode($result))->original->message
			], \App\Message\Message::ERROR_CODE_400);
		}
		return $this->create($params);
	}

	public function edit($id, array $params){
		$result = $this->validateRoleRoute($params);
		if(json_decode(json_encode($result))->original->error > 0 ){
			return response()->json([
				'error' => 1,
				'message' => json_decode(json_encode($result))->original->message
			], \App\Message\Message::ERROR_CODE_400);
		}
		return $this->update($id, $params);
	}
}