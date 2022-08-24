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

    public function getModel()
    {
        return \App\Models\Category::class;
    }

    /**
     * Get 5 posts hot in a month the last
     * @return mixed
     */
    public function getCategoryHost()
    {
        return $this->_model::where('created_at', '>=', Carbon::now()->subMonth())->orderBy('created_at', 'desc')->take(10)->get();
    }

    public function create(array $attributes){
        $this->_model::create($attributes);
    }

    public function extraFunc(){

    }
}