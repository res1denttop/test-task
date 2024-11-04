<?php

declare(strict_types=1);

namespace App\Service;

use App\Contract\EmployeesRepositoryInterface;
use App\DTO\ListRequest;
use App\Entity\Employee;
use Knp\Component\Pager\PaginatorInterface;

readonly class EmployeeService
{
    public function __construct(
        private EmployeesRepositoryInterface $employeeRepository,
        private PaginatorInterface $paginator
    ) {
    }

    public function getList(ListRequest $request): array
    {
        $pagination = $this->paginator->paginate(
            $this->employeeRepository->getQuery(),
            $request->page,
            $request->perPage
        );

        return $pagination->getItems();
    }

    public function remove(Employee $employee): void
    {
        $this->employeeRepository->remove($employee);
    }
}
