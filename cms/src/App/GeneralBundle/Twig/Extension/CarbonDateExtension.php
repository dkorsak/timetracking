<?php

namespace App\GeneralBundle\Twig\Extension;

use Carbon\Carbon;

class CarbonDateExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            'next_week_start_date' => new \Twig_Filter_Method($this, 'getNextWeekStartDate'),
            'prev_week_start_date' => new \Twig_Filter_Method($this, 'getPrevWeekStartDate'),
            'start_week_date' => new \Twig_Filter_Method($this, 'getStartWeekDate'),
            'end_week_date' => new \Twig_Filter_Method($this, 'getEndWeekDate'),
            'prev_day' => new \Twig_Filter_Method($this, 'getPrevDay'),
            'next_day' => new \Twig_Filter_Method($this, 'getNextDay'),
            'convert_to_time' =>  new \Twig_Filter_Method($this, 'getTimeFromInteger'),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array();
    }

    /**
     * @param  \DateTime $date
     * @return \DateTime
     */
    public function getNextWeekStartDate(\DateTime $date)
    {
        return $this->getStartWeekDate($date)->addWeek();
    }

    /**
     * @param  \DateTime $date
     * @return \DateTime
     */
    public function getPrevWeekStartDate(\DateTime $date)
    {
        return $this->getStartWeekDate($date)->subWeek();
    }

    /**
     * @param  \DateTime $date
     * @return \DateTime
     */
    public function getStartWeekDate(\DateTime $date)
    {
        $carbonDate = Carbon::instance($date);
        $dayOfWeek = $carbonDate->dayOfWeek;
        if ($dayOfWeek == 0) {
            $dayOfWeek = 7;
        }

        return $carbonDate->subDays($dayOfWeek-1);
    }

    /**
     * @param  \DateTime $date
     * @return \DateTime
     */
    public function getEndWeekDate(\DateTime $date)
    {
        $carbonDate = Carbon::instance($date);
        $dayOfWeek = $carbonDate->dayOfWeek;
        if ($dayOfWeek == 0) {
            $dayOfWeek = 7;
        }

        return $carbonDate->addDays(7-$dayOfWeek);
    }

    /**
     * @param  \DateTime $date
     * @return \DateTime
     */
    public function getPrevDay(\DateTime $date)
    {
        $carbonDate = Carbon::instance($date);

        return $carbonDate->subDay();
    }

    /**
     * @param  \DateTime $date
     * @return \DateTime
     */
    public function getNextDay(\DateTime $date)
    {
        $carbonDate = Carbon::instance($date);

        return $carbonDate->addDay();
    }

    /**
     * @param  number $minutes
     * @return string
     */
    public function getTimeFromInteger($minutes)
    {
        $carbonStartDate = Carbon::create(null, null, null, 0, 0, 0);

        $carbonEndDate = clone $carbonStartDate;
        $carbonEndDate->addMinutes($minutes);

        $hours = $carbonEndDate->diffInHours($carbonStartDate);
        $carbonEndDate->subHours($hours);

        $minutes = $carbonEndDate->diffInMinutes($carbonStartDate);

        if (strlen($hours) == 1) {
            $hours = '0' . $hours;
        }

        if (strlen($minutes) == 1) {
            $minutes = '0' . $minutes;
        }

        return $hours . ':' . $minutes;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'app_general_twig_extension_carbon_date';
    }
}
