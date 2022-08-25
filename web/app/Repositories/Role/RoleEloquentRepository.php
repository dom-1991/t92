<?php
namespace App\Repositories\Role;

use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;
use DB;

class RoleEloquentRepository extends EloquentRepository implements RoleRepositoryInterface
{    

    // public function getModel()
    // {
    //     return DB::table('roles');
    // }
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

    public function getDB()
    {
        return DB::table('roles');
    }

    public function update($id, array $attributes){
        $this->update($id, $attributes);
    }

    public function delete($id){
        $this->delete($id);
    }

    

}