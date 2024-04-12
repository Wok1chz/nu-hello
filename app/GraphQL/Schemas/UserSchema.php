<?php

namespace App\GraphQL\Schemas;

use App\GraphQL\Queries\UserQuery;
use App\GraphQL\Types\UserType;
use Rebing\GraphQL\Support\Contracts\ConfigConvertible;

class UserSchema implements ConfigConvertible
{
    public function toConfig(): array
    {
        return [
            'query' => [
                UserQuery::class,
            ],

            'mutation' => [
                // ExampleMutation::class,
            ],

            'types' => [
                UserType::class,
            ],
        ];
    }
}
