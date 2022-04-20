<?php

namespace Tests\Api\Authenticated\v1\Employee;

use App\Models\EmployeeModel;
use Faker\Generator as FakerGenerator;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\WithoutMiddleware;
use Tests\Api\Authenticated\TestCase;

use function json_decode;

/**
 * Class CreateEmployeeTest.
 *
 * @coversDefaultClass \App\Http\Controllers\Authenticated\v1\Employee\EmployeeController
 */
class CreateEmployeeTest extends TestCase
{
    // Ignore middlewares
    use WithoutMiddleware;

    /**
     * Test employee creation with data provider.
     *
     * @test
     *
     * @dataProvider employeeDataProvider
     *
     * @covers ::insert
     *
     * @param string $name
     * @param string $email
     * @param int $statusCode
     *
     * @return void
     */
    public function insert(string $name, string $email, int $statusCode): void
    {
        // Act
        $this->post('/employee', [
            'name' => $name,
            'email' => $email,
        ]);

        // Assert
        $this->assertSame($statusCode, $this->response->getStatusCode());

        if ($statusCode === Response::HTTP_CREATED) {
            /** @var array $json */
            $json = json_decode($this->response->getContent(), true);

            /** @var EmployeeModel $employee */
            $employee = EmployeeModel::findOrFail($json['id']);

            $this->assertSame($name, $employee->name);
            $this->assertSame($email, $employee->email);
        }
    }

    /**
     * Test employee creation.
     *
     * @test
     *
     * @covers ::insert
     *
     * @return void
     */
    public function shouldFailForExistingEmail(): void
    {
        // Arrange
        /** @var FakerGenerator $faker */
        $faker = $this->makeFaker();

        /** @var string $name */
        $name = $faker->name;

        /** @var string $email */
        $email = $faker->email;

        // Act
        $this->post('/employee', [
            'name' => $name,
            'email' => $email,
        ]);

        // Assert
        $this->assertSame(Response::HTTP_CREATED, $this->response->getStatusCode());

        /** @var array $json */
        $json = json_decode($this->response->getContent(), true);

        /** @var EmployeeModel $employee */
        $employee = EmployeeModel::findOrFail($json['id']);

        $this->assertSame($name, $employee->name);
        $this->assertSame($email, $employee->email);

        /**
         * Failing case for existing email.
         */
        // Arrange
        $name = $faker->name; // Refresh for new name

        // Act
        $this->post('/employee', [
            'name' => $name,
            'email' => $email, // Email same as previous one
        ]);

        // Assert
        $this->assertSame(Response::HTTP_INTERNAL_SERVER_ERROR, $this->response->getStatusCode());
    }

    /**
     * Employee data provider.
     *
     * @return array
     */
    public function employeeDataProvider(): array
    {
        /** @var FakerGenerator $faker */
        $faker = $this->makeFaker();

        return [
            ['', $faker->email, Response::HTTP_UNPROCESSABLE_ENTITY], //Invalid name
            [$faker->name, $faker->email, Response::HTTP_CREATED], //Create user
            [$faker->name, $faker->name, Response::HTTP_UNPROCESSABLE_ENTITY], //Invalid email
        ];
    }
}
