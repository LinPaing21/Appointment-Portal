<?php

use App\Models\History;
use App\Models\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('move-to-history', function () {
    $expires = Schedule::where('start_time', '<', now())->where('accept', true);

    foreach ($expires->get() as $expire) {
        $history = new History;
        $history->title = $expire->title;
        $history->patient_id = $expire->patient_id;
        $history->docter_id = $expire->docter_id;
        $history->date = substr($expire->start_time, 0, 10);

        $history->save();
    }

    $expires->delete();
})->purpose('Move expired accepted schedule to history database.');

Artisan::command('delete-unaccepted-schedule', function () {
    $ignores = Schedule::where('start_time', '<', now())->where('accept', false)->delete();
})->purpose('Delete expired docter unaccepted schedule.');
