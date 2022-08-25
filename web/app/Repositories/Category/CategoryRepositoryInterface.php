<?php
namespace App\Repositories\Category;

interface CategoryRepositoryInterface{

	/**
     * get model
     * @return string
     */

    public function getModel();

    /**
     * Get 5 posts hot in a month the last
     * @return mixed
     */
    public function getCategoryHost();

    public function extraFunc();

}
