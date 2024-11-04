<?php

declare(strict_types=1);

namespace App\Contract;

use App\Entity\Employee;
use Doctrine\ORM\Query;

interface EmployeesRepositoryInterface
{
    public function getQuery(): Query;

    /**
     * @param array<Employee> $employees
     * @return void
     */
    public function saveBatch(array $employees): void;

    public function remove(Employee $employee): void;
}
