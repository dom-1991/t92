<?php
namespace App\Repositories\Post;

interface PostRepositoryInterface
{

    public function home();

    // public function getAll();

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    // public function find($id);

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    // public function update($id, array $attributes);

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    // public function delete($id);


    /**
     * Get 5 posts hot in a month the last
     * @return mixed
     */
    public function getPostHost();    
}