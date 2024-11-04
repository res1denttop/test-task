<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Entity\Employee;

class ListEmployeeMapper
{
    public function __construct(private readonly EmployeeMapper $employeeMapper)
    {
    }

    /**
     * @param array<Employee> $employees
     * @return array
     */
    public function toResponse(array $employees): array
    {
        $response = [];

        foreach ($employees as $employee) {
            $response[] = $this->employeeMapper->toResponse($employee);
        }

        return $response;
    }
}
