<?php

declare(strict_types=1);

namespace App\Contract;

use App\Entity\Employee;

interface ImportReaderAdapterInterface
{
    /**
     * @param resource $stream
     * @return \Generator<Employee>
     */
    public function readToEntity($stream): \Generator;
}
