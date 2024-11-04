<?php

declare(strict_types=1);

namespace App\Service\Import;

use App\Contract\ImportReaderAdapterInterface;
use App\Entity\Employee;
use League\Csv\Reader;

class CsvImportReaderAdapter implements ImportReaderAdapterInterface
{
    /**
     * @param resource $stream
     * @return \Generator<Employee>
     * @throws \League\Csv\Exception
     */
    public function readToEntity($stream): \Generator
    {
        $csv = Reader::createFromStream($stream);
        $csv->setHeaderOffset(0);

        foreach ($csv as $row) {
            $birthday = $this->getBirthDay(
                $row['Date of Birth'] ?? null,
                    $row['Time of Birth'] ?? null,
            );
            yield (new Employee())
                ->setEmployeeId($row['Emp ID'] ?? uniqid())
                ->setNamePrefix($row['Name Prefix'] ?? '-')
                ->setFirstName($row['First Name'] ?? '-')
                ->setMiddleInitial($row['Middle Initial'] ?? '-')
                ->setLastName($row['Last Name'] ?? '-')
                ->setGender($row['Gender'] ?? '-')
                ->setEmail($row['E Mail'] ?? '-')
                ->setBirthday($birthday)
                ->setBirthtime($birthday)
                ->setAge($row['Age in Yrs.'] ?? '-')
                ->setJoiningDate(isset($row['Date of Joining']) ? new \DateTime($row['Date of Joining']) : null)
                ->setAgeInCompany($row['Age in Company (Years)'] ?? '-')
                ->setPhoneNumber($row['Phone No.'] ?? '-')
                ->setPlaceName($row['Place Name'] ?? '-')
                ->setCountry($row['County'] ?? '-')
                ->setCity($row['City'] ?? '-')
                ->setZip($row['Zip'] ?? '-')
                ->setRegion($row['Region'] ?? '-')
                ->setUserName($row['User Name'] ?? '-');
        }
    }

    private function getBirthDay(?string $birthday, ?string $birthtime): ?\DateTimeInterface
    {
        preg_match('/\d{1,2}\/\d{1,2}\/\d{4}/', $birthday, $dayMatches);
        preg_match('/\d{2}:\d{2}:\d{2}\s(AM|PM)/', $birthtime, $timeMatches);

        if (empty($dayMatches)) {
            return null;
        }

        return new \DateTime(
            sprintf('%s %s', $dayMatches[0], $timeMatches[0] ?? null)
        );
    }
}
