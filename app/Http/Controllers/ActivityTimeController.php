<?php

namespace App\Http\Controllers;

use App\Models\ActivityTime;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ActivityTimeController extends ResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $user;
    
    public function __construct()
    {
        try {
            $this->user = JWTAuth::parseToken()->authenticate();
        } catch (\Throwable $th) {
            return $this->sendError("Token Invalido");
        }
    }

    public function index()
    {
        //
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
        // return $this->sendRes($request->all(), "Tiempo de actividad registrado", 201);
        try {
            $activityTime = new ActivityTime();
            $activityTime->date =  $request->date;
            $activityTime->time_hour = $request->time_hour;
            $activityTime->activity_id = $request->activity_id;
            $activityTime->save();
        } catch (\Throwable $th) {
            return $this->sendError("Tiempo de actividad no registrado revisa los datos ".$th);
        }
        return $this->sendRes($activityTime, "Tiempo de actividad registrado", 201);
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
        try {
            $activityTime = ActivityTime::find($id);
            
            if ($activityTime != null) {
                $activityTime->delete();
            } else {
                return $this->sendRes([], "Tiempo de actividad no encontrado");
            }
        } catch (\Throwable $th) {
            return $this->sendError("Error al eliminar el tiempo de actividad");
        }
        return $this->sendRes($activityTime, "Tiempo de actividad eliminado", 201);
    }
}
