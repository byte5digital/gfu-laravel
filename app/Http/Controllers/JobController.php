<?php

namespace App\Http\Controllers;

use App\Jobs\SendMail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function enqueue(Request $request){
        $details = ['email' => '7279849637-d7e00c@inbox.mailtrap.io'];
        // $emailJob = (new SendMail($details))->delay(Carbon::now()->addMinutes(1));
        // dispatch($emailJob);
        SendMail::dispatch($details);
    }
}
