<?php
declare(strict_types = 1);

namespace App\Job;

use App\Schedule\Exception\ScheduleException;
use App\Schedule\JobInterface;
use App\Schedule\MiddlewareInterface;

class JobMiddleware implements MiddlewareInterface
{
    public function handle(JobInterface $job, \Closure $next)
    {
        if (!$job instanceof JobInterface) {
            throw new ScheduleException('参数无效');
        }
        return $next($job);
    }

}
