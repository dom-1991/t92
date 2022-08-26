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
            $result = $this->_model->insert($attributes);
            $data['error'] = \App\Message\Message::ERROR_CODE_SUCCESS;;
            $data['message'] = \App\Message\Message::CREATE_SUCCESS;
        } catch (Exception $e) {   
            $data['error'] = \App\Message\Message::ERROR_CODE_FAIL;
            $data['message'] = $e->getMessage();      
        }

        return $data;

    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        try {
            $result = $this->_model->where('id', $id);
            if ($result) {
                $result->update($attributes);
            }
            $data['error'] = \App\Message\Message::ERROR_CODE_SUCCESS;;
            $data['message'] = \App\Message\Message::UPDATE_SUCCESS;
        } catch (Exception $e) {
            $data['error'] = \App\Message\Message::ERROR_CODE_FAIL;
            $data['message'] = $e->getMessage();
        }        
        return $data;
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        try {
            $result = $this->_model->where('id', $id);
            if ($result) {
                $result->delete();
            }
            $data['error'] = \App\Message\Message::ERROR_CODE_SUCCESS;
            $data['message'] = \App\Message\Message::DELETE_SUCCESS;
        } catch (Exception $e) {
            $data['error'] = \App\Message\Message::ERROR_CODE_FAIL;
            $data['message'] = $e->getMessage();
        }        
        return $data;
    }

}