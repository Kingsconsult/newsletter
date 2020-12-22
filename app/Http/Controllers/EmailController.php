<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Gmail;
use App\Jobs\SendEmailJob;
use Carbon\Carbon;

class EmailController extends Controller
{
    public function sendEmail()
    {
        Mail::to('kingsconsult001@gmail.com')->send(new Gmail());
        echo 'email sent';
    }
    public function sendEmailJob()
    {

        
        $now = Carbon::now();
        $month = $now->format('F');
        $year = $now->format('yy');

        $secondTuesdayMonthly = new Carbon('third sunday of' . $month . ' ' . $year);

        print_r($secondTuesdayMonthly);
        exit();

        $emailJob = (new SendEmailJob())->delay(Carbon::now()->addSeconds(10));
        dispatch($emailJob);

        
     
        echo 'email sent job';
    }
}
