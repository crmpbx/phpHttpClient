<?php

namespace crmpbx\httpClient;

class Timer
{
    private float $start;

    public function __construct(float $time)
    {
        $this->start = $time;
    }
    /**
     * @return array
     * ['start'=>(float)timestamp, 'end'=>(float)timestamp, 'passTime'=>(float)end-start
     */
    public function getStampForCurrentTime(float $endTime): array
    {
        $startTime = $this->start;
        $passTime = round($endTime - $startTime, 4);
        return compact($startTime, $endTime, $passTime);
    }

}