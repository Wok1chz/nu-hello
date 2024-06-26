<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\User;
use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Database\Eloquent\Collection;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class UserQuery extends Query
{
    protected $attributes = [
        'name' => 'user',
        'description' => 'A query',
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('User'))));
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
            ],
            'name' => [
                'type' => Type::string(),
            ],
            'email' => [
                'type' => Type::string(),
            ],
            'phoneNumber' => [
                'type' => Type::string(),
            ],
            'isActive' => [
                'type' => Type::boolean(),
            ],
            'isMale' => [
                'type' => Type::boolean()
            ],
            'appearance' => [
                'type' => GraphQL::type('Appearance')
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $query = User::query();

        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();


        $query->select($select)
              ->with($with);

        if (isset($args['id'])) {
            $query->where('id' , $args['id']);
        }

        if (isset($args['email'])) {
            $query->where('email' , $args['email'])->get();
        }

        if (isset($args['isActive'])) {
            $query->where('is_active' , $args['isActive'])->get();
        }

        if (isset($args['isMale'])) {
            $query->where('is_male' , $args['isMale'])->get();
        }

        return $query->get();
    }
}
