<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Admin\AdminInterface;
use App\Http\Requests\AdminRequest;

class AdminController extends Controller
{

    public $adminRepository;

    public function __construct(AdminInterface $adminRepository){
        $this->middleware('permission');        
        $this->adminRepository = $adminRepository;
    }

    public function index(Request $request){
        return $this->adminRepository->getList($request->all());
    }

    public function store(AdminRequest $request){
        return $this->adminRepository->store(array_merge(
            $request->validated(),
            ['password' => bcrypt($request->password)]
        ));
    }

    public function update($id, AdminRequest $request){
        return $this->adminRepository->edit($id, array_merge(
            $request->validated(),
            ['password' => bcrypt($request->password)]
        ));
    }

    public function destroy($id){
        return $this->adminRepository->destroy($id);
    }

}
