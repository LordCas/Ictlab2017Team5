<?php

namespace App\Http\Controllers;

use App\Plant;
use App\ActionType;
use App\PlantActionLog;

class PlantController extends Controller
{
    public function new()
    {
    	$plant = new Plant;
    	$plant->name = $this->request->name;
    	$plant->save();

    	$action_type = ActionType::where('name', 'Exploring')->first();
    	$plant->newAction($action_type);

    	return $plant;
    }

    public function remove()
    {
        $plant = Plant::findOrFail($this->request->id);
        $plant->delete();

        return $this->plants();
    }

    public function plants()
    {
    	$plants = Plant::orderBy('created_at', 'desc')->get();

        $result = array(
            "status" => true,
            "plants" => $plants
        );

    	return $result;
    }

    public function action()
    {
        $plant = Plant::findOrFail($this->request->id);
        $action_type = ActionType::where('name', title_case($this->request->action))->first();
        $plant->newAction($action_type);

        return array("status" => true);
    }

    public function getCurrentAction()
    {
    	$action = PlantActionLog::active()->with('plant')->with('type')->first();

        if($action)
        {
            return array(
                    "status"    => true,
                    "action"    => $action
                );
        }
    	
        return array("status" => false);
    }

    public function finishAction()
    {
        PlantActionLog::deactivateActiveLogs();
    }
}
