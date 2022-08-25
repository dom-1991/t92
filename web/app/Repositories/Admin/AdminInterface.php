<?php

namespace App\Repositories\Admin;

interface AdminInterface
{
    /**
     * Get list admin
     * @return mixed
     */
    public function getListAmin(array $filters);


}