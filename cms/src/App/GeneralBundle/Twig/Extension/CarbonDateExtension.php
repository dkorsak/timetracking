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
     * @param \DateTime $date
     * @return \DateTime
     */
    public function getNextWeekStartDate(\DateTime $date)
    {
        return $this->getStartWeekDate($date)->addWeek();
    }

    /**
     * @param \DateTime $date
     * @return \DateTime
     */
    public function getPrevWeekStartDate(\DateTime $date)
    {
        return $this->getStartWeekDate($date)->subWeek();
    }

    /**
     * @param \DateTime $date
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
     * @param \DateTime $date
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
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'app_general_twig_extension_carbon_date';
    }
}