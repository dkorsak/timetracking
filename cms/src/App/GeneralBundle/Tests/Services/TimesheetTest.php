<?php

namespace App\GeneralBundle\Tests\Services;

use App\GeneralBundle\Entity\Timesheet;
use App\GeneralBundle\Tests\BasePHPUnitTest;

class TimesheetTest extends BasePHPUnitTest
{
    /**
     * @var Timesheet
     */
    protected $service;

    public function setUp()
    {
        parent::setUp();
        $this->service = new Timesheet();
    }

    public function testGetCurrentDate()
    {
        //TODO
    }

    public function testGetCurrentDateThrowInvalidArgumentException()
    {
        //TODO
    }
}