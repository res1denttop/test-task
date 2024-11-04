<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Entity\Employee;

class EmployeeMapper
{
    public function toResponse(Employee $employee): array
    {
        return [
            'empId' => $employee->getEmployeeId(),
            'namePrefix' => $employee->getNamePrefix(),
            'firstName' => $employee->getFirstName(),
            'middleInitial' => $employee->getMiddleInitial(),
            'lastName' => $employee->getLastName(),
            'gender' => $employee->getGender(),
            'email' => $employee->getEmail(),
            'birthday' => $employee->getBirthday()?->format('m/d/Y'),
            'birthtime' => $employee->getBirthtime()?->format('H:i:s'),
            'ageInYears' => $employee->getAge(),
            'dateOfJoining' => $employee->getJoiningDate()?->format('m/d/Y'),
            'ageInCompany' => $employee->getAgeInCompany(),
            'phoneNumber' => $employee->getPhoneNumber(),
            'placeName' => $employee->getPlaceName(),
            'country' => $employee->getCountry(),
            'city' => $employee->getCity(),
            'zip' => $employee->getZip(),
            'region' => $employee->getRegion(),
            'userName' => $employee->getUserName(),
        ];
    }
}
