<?php

namespace Chema\ApiUserService\Tests;

use Chema\ApiService\DTOs\UserDTO;
use PHPUnit\Framework\TestCase;
use Chema\ApiService\UserService;
use Exception;

class UserServiceTest extends TestCase
{
    private UserService $service;

    protected function setUp(): void
    {
        $this->service = new UserService();
    }

    /**
     * Test getUserById function
     */
    public function testGetUserById(): void
    {
        // Test valid ID
        $userId = 1;
        $user = $this->service->getUserById($userId);
        $this->assertInstanceOf(UserDTO::class, $user);
        $this->assertEquals($user->id, $userId);

        // Test invalid ID - Throws an Exception
        $userId = 0;
        $this->expectException(Exception::class);
        $user = $this->service->getUserById($userId);
    }

    /**
     * Test getUsersListByPage function
     */
    public function testGetUsersListByPage(): void
    {
        // Test valid page number
        $page = 1;
        $usersPerPage = 6;
        $users = $this->service->getUsersListByPage($page);

        $this->assertIsArray($users);
        $this->assertCount($usersPerPage, $users);
        $this->assertInstanceOf(UserDTO::class, $users[0]);
        $this->assertEquals(1, $users[0]->id);
        $this->assertEquals(2, $users[1]->id);
        $this->assertEquals(3, $users[2]->id);
        $this->assertEquals(4, $users[3]->id);
        $this->assertEquals(5, $users[4]->id);
        $this->assertEquals(6, $users[5]->id);

        // Test invalid page number
        $page = 3;
        $users = $this->service->getUsersListByPage($page);

        $this->assertIsArray($users);
        $this->assertEmpty($users);
    }

    /**
     * Test createUser function
     */
    public function testCreateUser(): void
    {
        $newUserData = [
            'first_name'    => 'Chema',
            'last_name'     => 'Fernandez',
            'job'           => 'Senior Developer',
        ];
        $newUserId = $this->service->createUser($newUserData);

        $this->assertIsInt($newUserId);
    }
}
