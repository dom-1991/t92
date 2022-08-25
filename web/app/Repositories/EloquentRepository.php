<?php

namespace App\Repositories;
use App\Repositories\RepositoryInterface;
use Exception;

abstract class EloquentRepository implements RepositoryInterface
{
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
    public function getAll($params)
    {   
        return $this->_model->get();
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($params)
    {
        $result = $this->_model->where(function($query) use ($params){
            $query->where('id', $params);
        })->get();
        return $result;
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        try {
            return $this->_model->insert($attributes);
        } catch (Exception $e) {
            if (str_contains($e->getMessage(), 'SQLSTATE[23000]:')) { 
                return [
                    'error' => 1,
                    'message' => \App\Message\Message::UNIQUE_FOREIN_KEY
                ];
            }
            return $e->getMessage();
        }
        
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