<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\User as ResourcesUser;
use App\User;

class UsersController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $user = $request->user();
        return $this->sendResponse(new ResourcesUser($user), 'Get User data successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, User $user)
    {
        // dd($request-all());
        $user->update([
            'name' => $request->name,
        ]);

        if($file = $request->file('avatar')){
            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);
            if($user->avatar){
                unlink(public_path().$user->avatar->path);
                $user->avatar()->update([
                    'path' => $name
                ]);
            }else{
                $user->avatar()->create([
                    'path' => $name
                ]);
            }
        }

        return $this->sendResponse($request->all(), 'Update User data successfully.');
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
