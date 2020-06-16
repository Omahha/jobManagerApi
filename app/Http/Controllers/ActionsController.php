<?php

namespace App\Http\Controllers;

use App\Action as AppAction;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Action;
use App\Http\Resources\ActionCollection;
use App\User;
use Illuminate\Support\Carbon;
use Exception;
use Illuminate\Database\QueryException;

class ActionsController extends BaseController
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
        return $this->sendResponse(new ActionCollection($user->actions), 'Get actions successfully');
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
        $user = $request->user();
        try{
            $action = $user->actions()->create([
                'title' => $request->name,
                'company_id' => $request->company_id,
                'status' => $request->detail,
                'place' => $request->place,
                'scheduleFrom' => Carbon::createFromFormat('Y-m-d H:i', $request->start),
                'scheduleTo' => Carbon::createFromFormat('Y-m-d H:i', $request->end),
                'color' => $request->color
            ]);
            return $this->sendResponse(new Action($action), 'Get actions successfully');
        }
        catch(QueryException $qe){
            if($qe->getCode()){
                return sendError($qe->getMessage(), 'ERROR!!');
            }

        }



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
    public function update(Request $request, $user, $action)
    {
        //
        $thisUser = $request->user();
        $thisAction = AppAction::findOrFail($action);
        $thisAction->update([
            'status' => $request->detail
        ]);

        return $this->sendResponse(new ActionCollection($thisUser->actions), 'Update action successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $user, $action)
    {
        //
        $user = $request->user();
        $action = AppAction::findOrFail($action);
        $action->delete();

        return $this->sendResponse(new ActionCollection($user->actions), 'Delete action successfully');
    }
}
