<?php
declare(strict_types = 1);

namespace App\Dag\Task;

use App\Dag\Interfaces\DagInterface;
use App\Kernel\Concurrent\ConcurrentMySQLPattern;

class Task3 implements DagInterface
{
    /**
     * @var bool
     */
    public $next;

    /**
     * @inheritDoc
     */
    public function Run(ConcurrentMySQLPattern $pattern) : void
    {
        var_dump($pattern->getPDO()->commit());
    }

    public function isNext() : bool
    {
        return $this->next;
    }
}
