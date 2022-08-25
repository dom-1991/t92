<?php
namespace App\Repositories\Post;

use App\Repositories\RepositoryInterface;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;

class PostEloquentRepository extends EloquentRepository implements PostRepositoryInterface
{

    public function home(){
        return $this->_model::where('created_at', '>=', Carbon::now()->subMonth())->orderBy('created_at', 'desc')->take(5)->get(); 
    }

    /**
     * get model
     * @return string
     */

    public function getDB()
    {
        return \App\Models\Post::class;
    }

    /**
     * Get 5 posts hot in a month the last
     * @return mixed
     */
    public function getPostHost()
    {
        return $this->_model::where('created_at', '>=', Carbon::now()->subMonth())->orderBy('created_at', 'desc')->take(5)->get();
    }

    public function create(array $attributes){
        $this->_model::create($attributes);
    }
}