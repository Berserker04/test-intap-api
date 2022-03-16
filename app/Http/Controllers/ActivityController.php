<?php

namespace App\Http\Controllers;

use App\Models\activity;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class ActivityController extends ResponseController
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
        $activities = activity::orderBy('id', 'DESC')
            ->where('user_id', "=", $this->user->id)
            ->get(["id", "description"]);
        return $this->sendRes($activities, "Lista de actividades");
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
        try {
            $activity = new Activity();
            $activity->description =  $request->description;
            $activity->user_id = $this->user->id;
            $activity->save();
        } catch (\Throwable $th) {
            return $this->sendError("Actividad no registrada revisa los datos");
        }
        return $this->sendRes($activity, "Actividad registrada", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
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
        try {
            $activity = Activity::find($id);

            if ($activity != null) {
                $activity->description =  $request->description;
                $activity->save();
            }else{
                return $this->sendRes([], "Actividad no encontrado");
            }
        } catch (\Throwable $th) {
            return $this->sendError("Actividad no actualizada revisa los datos");
        }

        return $this->sendRes($activity, "Actividad actualizada", 201);
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
            $activity = Activity::find($id);
            
            if ($activity != null) {
                $activity->delete();
            } else {
                return $this->sendRes([], "Actividad no encontrada");
            }
        } catch (\Throwable $th) {
            return $this->sendError("Error al eliminar la actividad");
        }
        return $this->sendRes($activity, "Actividad eliminada", 201);
    }
}
