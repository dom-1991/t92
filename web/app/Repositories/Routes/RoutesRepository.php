<?php 
namespace App\Repositories\Routes;

use App\Repositories\Routes\RoutesInterface;
use App\Repositories\EloquentRepository;
use DB;
use Illuminate\Http\Request;

class RoutesRepository extends EloquentRepository implements RoutesInterface {

	public function getDB(){
		return DB::table('routes');
	}

	public function getRoutes(array $params){
		return $this->_model->where(function($query) use($params){
            if(isset($params['id'])){
                $query->where('id', $params['id']);
            }
            if(isset($params['name_frontend'])){
                $query->where('name_frontend', $params['name_frontend']);
            }
            if(isset($params['name_backend'])){
                $query->where('name_backend', $params['name_backend']);
            }
            if(isset($params['title'])){
                $query->where('title', $params['title']);
            }
        })->get();
	}

	public function createRoute(array $params){
		return $this->create($params);
	}

	public function updateRoute($id, array $params){
		return $this->update($id, $params);
	}

	public function destroyRoute($id){
		return $this->delete($id);
	}	
}