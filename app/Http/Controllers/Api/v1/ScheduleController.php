<?php

namespace App\Http\Controllers\Api\v1;
use App\Http\Controllers\Controller;
use App\Schedule;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;



class ScheduleController  extends Controller
{
    use ApiResponser;
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return List of Schedule
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        //
        $schedules = Schedule::all();
        
        return $this->successResponse($schedules);
      
    }

    /**
     * Create one new Schedule
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request,[

            'clinic_id'=>'required|integer',
            'week_days'=>'required|string',
            'opening_time'=>'required|date_format:H:i',
            'closing_time'=>'required|date_format:H:i',
        ]);
       
        $schedule = Schedule::create($request->all());          
        return $this->successResponse($schedule,Response::HTTP_CREATED);
       
    }

    /**
     * get one Schedule
     *
     * @return Illuminate\Http\Response
     */
    public function show($schedule)
    {
        //

        $schedule = Schedule::findOrFail($schedule);
        return $this->successResponse($schedule);
        
    }

    /**
     * update an existing one Schedule
     *
     * @return Illuminate\Http\Response
     */
    public function update(Request $request,$schedule)
    {

        $this->validate($request,[

            'clinic_id'=>'integer',
            'week_days'=>'string',
            'opening_time'=>'date_format:H:i',
            'closing_time'=>'date_format:H:i',
        ]);
        
        $schedule = Schedule::findOrFail($schedule);
        $schedule->fill($request->all());

        
        if($schedule->isClean()){
            return $this->errorResponse("you didn't change any value",Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $schedule->save();
        return $this->successResponse($schedule);
    }

     /**
     * remove an existing one renewal
     *
     * @return Illuminate\Http\Response
     */
    public function destroy($schedule)
    {
        $schedule = Schedule::findOrFail($schedule);
        $schedule->delete();
        return $this->successResponse($schedule);
      
    }

}
