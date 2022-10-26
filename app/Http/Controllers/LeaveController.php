<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $results = Leave::with('user')->get();
        return response()->json(array('success' => true , 'data' => $results));

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
                'startDate' => 'required',
                'endDate' => 'required|after:startDate',
            ]);

            $user = Leave::create([
                'status' => 'pending',
                'user_id' => Auth::user()->id,
                'start_date' => $request->startDate,
                'end_date' => $request->endDate,

            ]);

            DB::Table('users')->whereid(Auth::user()->id)->decrement('leave_days');
            $res['success'] = true;

        return response()->json($res);


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
        $request->validate(['status' => 'required']);
        $leave = Leave::find($id);
        $leave->status = $request->status;
        $leave->save();
        return $this->index();
    }


}
