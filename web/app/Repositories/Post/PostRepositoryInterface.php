<?php
namespace App\Repositories\Post;

interface PostRepositoryInterface
{

    public function home();
    public function create(array $attributes);
    public function getPostHost();    

}