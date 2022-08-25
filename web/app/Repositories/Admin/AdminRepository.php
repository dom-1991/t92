<?php
namespace App\Repositories\Admin;

use App\Repositories\Admin\AdminInterface;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;
use DB;

class AdminRepository extends EloquentRepository implements AdminInterface
{
    /**
     * get model
     * @return string
     */

    public function getDB()
    {
        return \App\Models\User::class;
    }
    
    public function getListAmin(array $filters){

        $queryUser = $this->_model::query();
        $queryUser->orderBy('id','asc');
        if(isset($filters['name']) and !is_null($filters['name'])) {
            $queryUser->where('name','=',$filters['name']);
        }
        if(isset($filters['email']) and !is_null($filters['email'])) {
            $queryUser->where('email','=',$filters['email']);
        }
        $limit = 20;
        if(isset($filters['limit']) and !is_null($filters['limit'])) {
            $limit = $filters['limit'];
        }

        $result = $queryUser->paginate($limit);

        return $result;
    }

    

}