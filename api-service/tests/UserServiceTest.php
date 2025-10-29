<?php

namespace Chema\ApiUserService\Tests;

use Chema\ApiService\DTOs\UserDTO;
use Chema\ApiService\Exceptions\ApiException;
use PHPUnit\Framework\TestCase;
use Chema\ApiService\UserService;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;

class UserServiceTest extends TestCase
{
    private const VALID_USER_ID = 1;
    private const INVALID_USER_ID = 999;
    private const VALID_PAGE = 1;
    private const INVALID_PAGE = 999;

    //private UserService $service;

    protected function setUp(): void
    {
        //$this->service = new UserService();
    }

    private function createMockClient(?Response $response = null, ?Exception $exception = null): Client
    {
        $mock = $this->getMockBuilder(Client::class)
            ->onlyMethods(['get', 'post'])
            ->getMock();

        if ($exception) {
            $mock->method('get')->willThrowException($exception);
            $mock->method('post')->willThrowException($exception);
        } elseif ($response) {
            $mock->method('get')->willReturn($response);
            $mock->method('post')->willReturn($response);
        }

        return $mock;
    }

    /**
     * Test getUserById function with a valid ID
     */
    public function testGetUserByIdValidId(): void
    {
        $userData = [
            'data' => [
                'id' => 1,
                'first_name' => 'Chema',
                'last_name' => 'Fernandez',
                'email' => null,
                'avatar' => null,
                'job' => null,
            ]
        ];

        $response = new Response(200, [], json_encode($userData));
        $client = $this->createMockClient($response);
        $service = new UserService($client);

        $user = $service->getUserById(self::VALID_USER_ID);
        $this->assertInstanceOf(UserDTO::class, $user);
        $this->assertEquals(self::VALID_USER_ID, $user->id);

        /*
        $user = $this->service->getUserById(self::VALID_USER_ID);

        $this->assertInstanceOf(UserDTO::class, $user);
        $this->assertEquals(self::VALID_USER_ID, $user->id);
        */
    }

    /**
     * Test getUserById function with an invalid ID
     */
    public function testGetUserByIdInvalidId(): void
    {
        $exception = new RequestException(
            'User not found',
            $this->createMock(RequestInterface::class)
        );

        $client = $this->createMockClient(null, $exception);
        $service = new UserService($client);

        $this->expectException(ApiException::class);
        $service->getUserById(self::INVALID_USER_ID);

        /*
        $this->expectException(ApiException::class);
        $this->service->getUserById(self::INVALID_USER_ID);
        */
    }

    /**
     * Test getUsersListByPage function with a valid Page Number
     */
    public function testGetUsersListByPageValidPageNumber(): void
    {
        $usersData = [
            'data' => [
                [
                    'id' => 1,
                    'first_name' => 'Chema_1',
                    'last_name' => 'Fernandez_1',
                    'email' => null,
                    'avatar' => null,
                    'job' => null,
                ],
                [
                    'id' => 2,
                    'first_name' => 'Chema_2',
                    'last_name' => 'Fernandez_2',
                    'email' => null,
                    'avatar' => null,
                    'job' => null,
                ],
            ],
        ];

        $response = new Response(200, [], json_encode($usersData));
        $client = $this->createMockClient($response);
        $service = new UserService($client);

        $users = $service->getUsersListByPage(self::VALID_PAGE);

        $this->assertIsArray($users);
        $this->assertNotEmpty($users);
        $this->assertCount(2, $users);
        $this->assertContainsOnlyInstancesOf(UserDTO::class, $users);

        /*
        $users = $this->service->getUsersListByPage(self::VALID_PAGE);

        $this->assertIsArray($users);
        $this->assertNotEmpty($users);
        $this->assertContainsOnlyInstancesOf(UserDTO::class, $users);
        */
    }

    /**
     * Test getUsersListByPage function with an invalid Page Number
     */
    public function testGetUsersListByPageInvalidPageNumber(): void
    {
        $exception = new RequestException(
            'Error fetching users',
            $this->createMock(RequestInterface::class)
        );

        $client = $this->createMockClient(null, $exception);
        $service = new UserService($client);

        $this->expectException(ApiException::class);
        $service->getUsersListByPage(self::INVALID_PAGE);

        /*
        $users = $this->service->getUsersListByPage(self::INVALID_PAGE);

        $this->assertIsArray($users);
        $this->assertEmpty($users);
        */
    }

    /**
     * Test createUser function
     */
    public function testCreateUser(): void
    {
        $responseData = ['id' => rand(1, 999)];
        $response = new Response(201, [], json_encode($responseData));
        $client = $this->createMockClient($response);
        $service = new UserService($client);

        $newUserData = [
            'first_name'    => 'Chema',
            'last_name'     => 'Fernandez',
            'job'           => 'Senior Developer',
        ];
        $newUserId = $service->createUser($newUserData);

        $this->assertIsInt($newUserId);
        $this->assertGreaterThan(0, $newUserId);

        /*
        $newUserData = [
            'first_name'    => 'Firstname_' . time(),
            'last_name'     => 'Lastname_' . time(),
            'job'           => 'Job_' . time(),
        ];
        $newUserId = $this->service->createUser($newUserData);

        $this->assertIsInt($newUserId);
        $this->assertGreaterThan(0, $newUserId);
        */
    }
}
