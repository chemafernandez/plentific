<?php

namespace Chema\ApiService;

use Chema\ApiService\DTOs\UserDTO;
use Chema\ApiService\Exceptions\ApiException;
use GuzzleHttp\Client;
use Exception;

class UserService
{
    private const BASE_URL = "https://reqres.in/api/";
    private const API_KEY = "reqres-free-v1";

    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => rtrim(self::BASE_URL, '/') . '/',
            'headers' => [
                'x-api-key'     => self::API_KEY,
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
            ],
        ]);
    }

    /**
     * Retrieve an user by ID
     */
    public function getUserById(int $id): UserDTO
    {
        try {
            $response = $this->client->get("users/{$id}");
            $data = json_decode($response->getBody()->getContents(), true);
            return UserDTO::fromArray($data['data']);
        } catch (Exception $e) {
            throw new ApiException(
                "Error fetching user with ID {$id}: " . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * Retrieve a list of users per page
     */
    public function getUsersListByPage(int $page = 1): array
    {
        try {
            $response = $this->client->get("users?page={$page}");
            $data = json_decode($response->getBody()->getContents(), true);
            foreach ($data['data'] as $user) {
                $users[] = UserDTO::fromArray($user);
            }
            return $users ?? [];
        } catch (Exception $e) {
            throw new ApiException(
                "Error fetching users list with page number {$page}: " . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * Create an user and return the new User ID
     */
    public function createUser(array $userData): int
    {
        try {
            $response = $this->client->post("users", [
                'json' => $userData,
            ]);
            $data = json_decode($response->getBody()->getContents(), true);
            return (int)$data['id'];
            //return UserDTO::fromArray($data)->id;
        } catch (Exception $e) {
            throw new ApiException(
                "Error creating new user: " . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }
}
