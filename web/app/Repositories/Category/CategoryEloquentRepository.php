<?php 
namespace App\Repositories\Category;

use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;


class CategoryEloquentRepository extends EloquentRepository implements CategoryRepositoryInterface{
	/**
     * get model
     * @return string
     */

    public function getDB()
    {
        return \App\Models\Category::class;
    }

    public function create(array $attributes){
        $this->_model::create($attributes);
    }
    
    public function extraFunc(){

    }

}