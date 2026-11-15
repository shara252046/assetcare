<?php

use Illuminate\Support\Facades\Schedule;



//maintenence check korar jonno use hoyeche 
Schedule::command('maintenance:check')->dailyAt('07:00');


//warranty alert, reguler nije cholbe;
Schedule::command('warranty:alert')->dailyAt('08:00');



