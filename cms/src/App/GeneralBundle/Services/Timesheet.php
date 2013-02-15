<?php

namespace App\GeneralBundle\Services;

use Carbon\Carbon;

class Timesheet
{
    /**
     * @param  string $year
     * @param  string $month
     * @param  string $day
     * @return Carbon
     */
    public function getCurrentDate($year = "", $month = "", $day = "")
    {
        try {
            $currentDate = Carbon::create($year, $month, $day);
        } catch (\InvalidArgumentException $e) {
            $currentDate = Carbon::now();
        }

        return $currentDate;
    }
}
