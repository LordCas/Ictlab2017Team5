<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlantActionLog extends Model
{
	protected $hidden = ['created_at', 'updated_at'];

	public function plant()
	{
		return $this->belongsTo(Plant::class);
	}

	public function type()
	{
		return $this->belongsTo(ActionType::class);
	}

	public function scopeActive($query)
    {
        return $query->where('finish', 0);
    }

    public static function deactivateActiveLogs()
    {
    	$active_logs = PlantActionLog::where('finish', 0)->get();

    	foreach($active_logs as $active_log)
    	{
    		$active_log->finish = true;
    		$active_log->save();
    	}
    }
}
