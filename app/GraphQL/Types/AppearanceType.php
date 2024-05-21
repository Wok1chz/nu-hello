<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Models\Appearance;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class AppearanceType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Appearance',
        'description' => 'A type',
        'model' => Appearance::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'alias' => 'id'
            ],
            'height' => [
                'type' => Type::int(),
                'alias' => 'height'
            ],
            'weight' => [
                'type' => Type::int(),
                'alias' => 'weight'
            ],
        ];
    }
}
