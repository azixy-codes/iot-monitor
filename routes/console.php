<?php

use App\Console\Commands\AppScriptRun;
use Illuminate\Support\Facades\Schedule;

Schedule::command(AppScriptRun::class)->everyMinute()->runInBackground();
