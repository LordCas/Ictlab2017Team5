<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\PlantActionLog;

class Plant extends Model
{
    use SoftDeletes;

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    public function plant_action_logs()
    {
    	return $this->hasMany(PlantActionLog::class);
    }

    public function newAction($action)
    {
    	PlantActionLog::deactivateActiveLogs();

    	$log = new PlantActionLog;
    	$log->plant_id = $this->id;
    	$log->type_id = $action->id;
    	$log->finish = false;
    	$log->save();

    	return true;
    }
}
