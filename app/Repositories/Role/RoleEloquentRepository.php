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

    public function getDB()
    {
        return DB::table('roles');
    }

    public function getAllRole(){
        return $this->getAll(); 
    }

    public function create(array $attributes){
        $this->create($attributes);
    }

    public function update($id, array $attributes){
        $this->update($id, $attributes);
    }

    public function delete($id){
        $this->delete($id);
    }

    

}