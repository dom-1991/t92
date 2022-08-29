<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Role\RoleRouteInterface;
use App\Http\Requests\RoleRouteRequest;

class RoleRouteController extends Controller
{

    public $roleRouteRepository;
    public function __construct(RoleRouteInterface $roleRouteRepository){
        $this->roleRouteRepository = $roleRouteRepository;
    }

    public function index(Request $request){
        return $this->roleRouteRepository->getRoleRoute($request->all());
    }

    public function store(RoleRouteRequest $request){
        return $this->roleRouteRepository->store($request->all());
    }

    public function update($id, RoleRouteRequest $request){
        return $this->roleRouteRepository->edit($id, $request->all());
    }

    public function destroy($id){
        return $this->roleRouteRepository->delete($id);
    }
    
}
