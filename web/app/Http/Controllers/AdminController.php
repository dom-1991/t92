<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Admin\AdminInterface;

class AdminController extends Controller
{

    public $adminRepository;

    public function __construct(AdminInterface $adminRepository){
        $this->middleware('permission');        
        $this->adminRepository = $adminRepository;
    }

    public function getListAmin(Request $request){
        $filter = $request->all();
        return $this->adminRepository->getListAmin($filter);
    }
}
