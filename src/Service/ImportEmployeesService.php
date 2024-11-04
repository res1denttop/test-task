<?php

declare(strict_types=1);

namespace App\Service;

use App\Contract\EmployeesRepositoryInterface;
use App\Contract\ImportReaderAdapterInterface;
use App\DTO\ImportRequest;

class ImportEmployeesService
{
    public function __construct(
        private readonly ImportReaderAdapterInterface $importReaderAdapter,
        private readonly EmployeesRepositoryInterface $employeesRepository,
    ) {
    }

    public function import(ImportRequest $importRequest): void
    {
        $batch = [];
        $stream = $importRequest->getStream();

        foreach (
            $this->importReaderAdapter->readToEntity($stream) as $entity
        ) {
            $batch[] = $entity;

            if (count($batch) === 50) {
                $this->employeesRepository->saveBatch($batch);
                $batch = [];
            }
        }

        fclose($stream);
    }
}
