<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Role\RoleRepositoryInterface;

class RoleController extends Controller
{

    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->roleRepository->getRoles($request->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {        
        return $this->roleRepository->create($request->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50'
        ]);
        $result = $this->roleRepository->create($request->all());
        if($result == true){
            return response()->json([
                'error' => 0,
                'message' => \App\Message\Message::CREATE_SUCCESS
            ]);
        }
        if($result == \App\Message\Message::UNIQUE_FOREIN_KEY){
            return response()->json([
                'error' => 1,
                'message' => \App\Message\Message::UNIQUE_FOREIN_KEY
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($params)
    {                
        return $this->roleRepository->find($params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
