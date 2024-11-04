<?php

namespace App\Repository;

use App\Contract\EmployeesRepositoryInterface;
use App\Entity\Employee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Employee>
 */
class EmployeeRepository extends ServiceEntityRepository implements EmployeesRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Employee::class);
    }

    public function getQuery(): Query
    {
        return $this->createQueryBuilder('e')->getQuery();
    }

    public function saveBatch(array $employees): void
    {
        $sql = "INSERT INTO employee (employee_id, user_name, name_prefix, first_name, middle_initial, last_name, gender, email, birthday, birthtime, age, joining_date, age_in_company, phone_number, place_name, country, city, zip, region) 
            VALUES %s ON DUPLICATE KEY UPDATE 
                user_name = VALUES(user_name), 
                name_prefix = VALUES(name_prefix),
                first_name = VALUES(first_name),
                middle_initial = VALUES(middle_initial),
                last_name = VALUES(last_name),
                gender = VALUES(gender),
                email = VALUES(email),
                birthday = VALUES(birthday),
                birthtime = VALUES(birthtime),
                age = VALUES(age),
                joining_date = VALUES(joining_date),
                age_in_company = VALUES(age_in_company),
                phone_number = VALUES(phone_number),
                place_name = VALUES(place_name),
                country = VALUES(country),
                city = VALUES(city),
                zip = VALUES(zip),
                region = VALUES(region)";

        $placeholders = [];
        $params = [];

        foreach ($employees as $employee) {
            $placeholders[] = "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $params = array_merge(
                $params,
                [
                    $employee->getEmployeeId(),
                    $employee->getUserName(),
                    $employee->getNamePrefix(),
                    $employee->getFirstName(),
                    $employee->getMiddleInitial(),
                    $employee->getLastName(),
                    $employee->getGender(),
                    $employee->getEmail(),
                    $employee->getBirthday()->format('Y-m-d H:i:s'),
                    $employee->getBirthtime()->format('Y-m-d H:i:s'),
                    $employee->getAge(),
                    $employee->getJoiningDate()->format('Y-m-d H:i:s'),
                    $employee->getAgeInCompany(),
                    $employee->getPhoneNumber(),
                    $employee->getPlaceName(),
                    $employee->getCountry(),
                    $employee->getCity(),
                    $employee->getZip(),
                    $employee->getRegion(),
                ]
            );
        }

        $this->getEntityManager()->getConnection()->executeQuery(
            sprintf($sql, implode(',', $placeholders)),
            $params
        );
    }

    public function remove(Employee $employee): void
    {
        $this->getEntityManager()->remove($employee);
        $this->getEntityManager()->flush();
    }
}
