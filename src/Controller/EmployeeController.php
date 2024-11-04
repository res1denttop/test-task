<?php

namespace App\Controller;

use App\DTO\ListRequest;
use App\Entity\Employee;
use App\Mapper\EmployeeMapper;
use App\Mapper\ListEmployeeMapper;
use App\Message\ImportEmployeeMessage;
use App\Service\EmployeeService;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/employee', name: 'employee')]
class EmployeeController
{
    public function __construct(
        private readonly EmployeeService $employeeService,
        private readonly MessageBusInterface $bus
    ) {
    }

    #[Route('', name: 'employee_list', methods: ['GET'])]
    public function getEmployees(Request $request, ListEmployeeMapper $listEmployeeMapper): Response
    {
        return new JsonResponse(
            $listEmployeeMapper->toResponse(
                $this->employeeService->getList(
                    new ListRequest(
                        $request->get('page', 1),
                        $request->get('perPage', 25)
                    )
                )
            )
        );
    }

    #[Route('/{id}', name: 'employee_get', methods: ['GET'])]
    public function getEmployee(#[MapEntity] Employee $employee, EmployeeMapper $employeeMapper): Response
    {
        return new JsonResponse(
            $employeeMapper->toResponse($employee)
        );
    }

    #[Route('', name: 'employee_import_list', methods: ['POST'])]
    public function importEmployees(
        Request $request
    ): Response {
        $this->bus->dispatch(new ImportEmployeeMessage($request));

        return new Response('ok');
    }

    #[Route('/{id}', name: 'employee_delete', methods: ['DELETE'])]
    public function deleteEmployee(#[MapEntity] Employee $employee, Request $request): Response
    {
        $this->employeeService->remove($employee);

        return new Response(status: Response::HTTP_NO_CONTENT);
    }
}
