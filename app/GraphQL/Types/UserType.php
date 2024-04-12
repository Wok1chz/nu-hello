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
                'description' => 'The id of the user',
                'alias' => 'id'
            ],
            'name' => [
                'name' => 'name', 
                'type' => Type::string(),
                'alias' => 'name'
            ],
            'email' => [
                'name' => 'email', 
                'type' => Type::string(),
                'alias' => 'email'
            ],
        ];
    }
}
