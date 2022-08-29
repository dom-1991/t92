<?php
namespace App\Repositories\Admin;

use App\Repositories\Admin\AdminInterface;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;
use DB;
// use Illuminate\Support\Facades\Hash;

class AdminRepository extends EloquentRepository implements AdminInterface
{
    /**
     * get model
     * @return string
     */
    
    const LIMIT = 20;

    public function getDB()
    {
        return DB::table('users');
    }

    public function getList(array $params){
        return $this->_model->where(function($query) use($params){
            if(isset($params['id'])){
                $query->where('id', $params['id']);
            }
            if(isset($params['name'])){
                $query->where('name', $params['name']);
            }
            if(isset($params['email'])){
                $query->where('email', $params['email']);
            }
        })->paginate($params['limit']??self::LIMIT);
    }

    public function store(array $params){
        return $this->create($params);
    }

    public function edit($id, array $params){
        return $this->update($id, $params);
    }

    public function destroy($id){
        return $this->delete($id);
    }
    
    public function getListEloquent(array $filters){

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

    public function getModel()
    {
        return \App\Models\User::class;
    }

}