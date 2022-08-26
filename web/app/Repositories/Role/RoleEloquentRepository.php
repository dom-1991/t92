<?php
namespace App\Repositories\Role;

use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class RoleEloquentRepository extends EloquentRepository implements RoleRepositoryInterface
{    

    public function getDB()
    {
        return DB::table('roles');
    }

    public function getRoles($params){
        return $this->_model->where(function($query) use($params){
            if(isset($params['id'])){
                $query->where('id', $params['id']);
            }
            if(isset($params['name'])){
                $query->where('name', $params['name']);
            }
        })->get();
    }

    public function createRole(array $attributes){
        return $this->create($attributes);
    }

    public function updateRole($id, array $attributes){
        return $this->update($id, $attributes);
    }

    public function destroyRole($id){
        return $this->delete($id);
    }

    

}