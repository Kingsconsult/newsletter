<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;



class Cron extends Model
{
    use HasFactory;

    protected $primaryKey = 'command';

    protected $fillable = ['command', 'next_run', 'last_run'];
    

    
    public static function shouldIRun($command, $minutes) {
        $cron = Cron::find($command);
        $now  = Carbon::now();
        if ($cron && $cron->next_run > $now->timestamp) {
            return false;
        }
        Cron::updateOrCreate(
            ['command'  => $command],
            ['next_run' => Carbon::now()->addMinutes($minutes)->timestamp,
             'last_run' => Carbon::now()->timestamp]
        );
        return true;
}


}
