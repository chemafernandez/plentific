<?php

namespace Chema\ApiService\DTOs;

use JsonSerializable;

class UserDTO implements JsonSerializable
{
    public function __construct(
        public readonly int $id,
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly ?string $email = null,
        public readonly ?string $avatar = null,
        public readonly ?string $job = null,
    ) {
    }

    /**
     * Convert DTO to an array
     * 
     * @return array<string, int|string|null>
     */
    public function toArray(): array
    {
        return [
            'id'            => $this->id,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'email'         => $this->email,
            'avatar'        => $this->avatar,
            'job'           => $this->job,
        ];
    }

    /**
     * Serialise DTO to JSON
     * 
     * @return array<string, int|string|null>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * Create a DTO from an array
     * 
     * @param array<string, int|string|null> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            first_name: $data['first_name'],
            last_name: $data['last_name'],
            email: $data['email'] ?? null,
            avatar: $data['avatar'] ?? null,
            job: $data['job'] ?? null,
        );
    }
}
