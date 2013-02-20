<?php

namespace App\GeneralBundle\Services;

use Doctrine\Common\Persistence\ObjectManager;
use Carbon\Carbon;

class Timesheet
{
    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * Constructor
     *
     * @param ObjectManager $em
     */
    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
    }

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

    /**
     * @param  \DateTime $date
     * @param  integer   $userId
     * @return array
     */
    public function getWeeklyTimesheet(\DateTime $date, $userId)
    {
        $timesheet = array();
        $timesheetRepository = $this->em->getRepository('AppGeneralBundle:Timesheet');

        $result = $timesheetRepository->getWeeklyTimesheet($date->format('Y'), $date->format('W'), $userId);

        foreach ($result as $item) {
            $timesheet[$item['id']]['company_name'] = $item['company_name'];
            $timesheet[$item['id']]['project_name'] = $item['project_name'];
            $timesheet[$item['id']]['task_name'] = $item['task_name'];
            $timesheet[$item['id']]['days'][$item['day']] = $item['time'];
        }

        return $timesheet;
    }
    
    /**
     * @param \DateTime $date
     * @param integer $userId
     * @return array
     */
    public function getDailyTimesheet(\DateTime $date, $userId)
    {
        $timesheet = array();
        $timesheetRepository = $this->em->getRepository('AppGeneralBundle:Timesheet');
        
        $result = $timesheetRepository->getDailyTimesheet($date->format('Y'), $date->format('W'), $date->format('N'), $userId);

        foreach ($result as $item) {
            $timesheet[$item['id']]['company_name'] = $item['company_name'];
            $timesheet[$item['id']]['project_name'] = $item['project_name'];
            $timesheet[$item['id']]['task_name'] = $item['task_name'];
            $timesheet[$item['id']]['time'] = $item['time'];
        }

        return $timesheet;
    }
}
