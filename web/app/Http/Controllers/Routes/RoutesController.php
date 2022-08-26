<?php

namespace App\Http\Controllers\Routes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Routes\RoutesInterface;
use App\Http\Requests\RoutesRequest;

class RoutesController extends Controller
{
    public $routesRepository;
    public function __construct(RoutesInterface $routesRepository){
        $this->routesRepository = $routesRepository;
    }

    public function index(Request $request){        
        return $this->routesRepository->getRoutes($request->all());
    }

    public function store(RoutesRequest $request){
        return $this->routesRepository->createRoute($request->all());
    }

    public function update($id, RoutesRequest $request){
        return $this->routesRepository->updateRoute($id, $request->all());
    }

    public function destroy($id){
        return $this->routesRepository->destroyRoute($id);
    }
}
