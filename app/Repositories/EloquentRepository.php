<?php

namespace App\Repositories;
use App\Repositories\RepositoryInterface;

abstract class EloquentRepository implements RepositoryInterface
{

    public function hello(){
        return "Hello world";
    }

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $_model;

    /**
     * EloquentRepository constructor.
     */
    public function __construct()
    {
        $this->setDB();
    }

    /**
     * get model
     * @return string
     */
    // abstract public function getModel();
    abstract public function getDB();

    /**
     * Set model
     */
    // public function setModel()
    // {
    //     $this->_model = app()->make(
    //         $this->getModel()
    //     );
    // }

    public function setDB()
    {
        $this->_model = $this->getDB();
    }

    /**
     * Get All
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {

        return $this->_model->get();
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->_model->find($id);

        return $result;
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {

        return $this->_model->create($attributes);
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

}