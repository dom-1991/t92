<?php
namespace App\Repositories\Role;

interface RoleRepositoryInterface
{
    public function getRoles($params);
    public function create(array $attributes);    
}