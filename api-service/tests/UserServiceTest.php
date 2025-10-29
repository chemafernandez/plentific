<?php

namespace Chema\ApiUserService\Tests;

use Chema\ApiService\DTOs\UserDTO;
use Chema\ApiService\Exceptions\ApiException;
use PHPUnit\Framework\TestCase;
use Chema\ApiService\UserService;

class UserServiceTest extends TestCase
{
    private const VALID_USER_ID = 1;
    private const INVALID_USER_ID = 999;
    private const VALID_PAGE = 1;
    private const INVALID_PAGE = 3;

    private UserService $service;

    protected function setUp(): void
    {
        $this->service = new UserService();
    }

    /**
     * Test getUserById function with a valid ID
     */
    public function testGetUserByIdValidId(): void
    {
        $user = $this->service->getUserById(self::VALID_USER_ID);
        $this->assertInstanceOf(UserDTO::class, $user);
        $this->assertEquals(self::VALID_USER_ID, $user->id);
    }

    /**
     * Test getUserById function with an invalid ID
     */
    public function testGetUserByIdInvalidId(): void
    {
        $this->expectException(ApiException::class);
        $user = $this->service->getUserById(self::INVALID_USER_ID);
    }

    /**
     * Test getUsersListByPage function with a valid Page Number
     */
    public function testGetUsersListByPageValidPageNumber(): void
    {
        $users = $this->service->getUsersListByPage(self::VALID_PAGE);

        $this->assertIsArray($users);
        $this->assertNotEmpty($users);
        foreach ($users as $user) {
            $this->assertInstanceOf(UserDTO::class, $user);
        }
    }

    /**
     * Test getUsersListByPage function with an invalid Page Number
     */
    public function testGetUsersListByPageInvalidPageNumber(): void
    {
        $users = $this->service->getUsersListByPage(self::INVALID_PAGE);

        $this->assertIsArray($users);
        $this->assertEmpty($users);
    }

    /**
     * Test createUser function
     */
    public function testCreateUser(): void
    {
        $newUserData = [
            'first_name'    => 'Firstname_' . time(),
            'last_name'     => 'Lastname_' . time(),
            'job'           => 'Job_' . time(),
        ];
        $newUserId = $this->service->createUser($newUserData);

        $this->assertIsInt($newUserId);
        $this->assertGreaterThan(0, $newUserId);
    }
}
