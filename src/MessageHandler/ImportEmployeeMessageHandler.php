<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\DTO\ImportRequest;
use App\Message\ImportEmployeeMessage;
use App\Service\ImportEmployeesService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class ImportEmployeeMessageHandler
{
    public function __construct(
        private readonly ImportEmployeesService $importEmployeesService,
    ) {
    }

    public function __invoke(ImportEmployeeMessage $message): void
    {
        $this->importEmployeesService->import(
            new ImportRequest($message->request)
        );
    }
}
