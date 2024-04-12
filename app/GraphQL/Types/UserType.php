<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A type',
        'model' => User::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'alias' => 'id'
            ],
            'name' => [
                'type' => Type::string(),
                'alias' => 'name'
            ],
            'email' => [
                'type' => Type::string(),
                'alias' => 'email'
            ],
            'phoneNumber' => [
                'type' => Type::string(),
                'alias' => 'phone_number'
            ],
            'isActive' => [
                'type' => Type::boolean(),
                'alias' => 'is_active'
            ],
        ];
    }
}
