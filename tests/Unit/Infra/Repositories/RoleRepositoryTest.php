<?php

namespace Tests\Unit;

use Mockery;
use Spatie\Permission\Models\Role;
use Src\Infra\Repositories\RoleRepository\RoleEloquentRepository;
use Tests\TestCase;

class RoleRepositoryTest extends TestCase
{
    public function test_should_create(): void
    {
        $mockModel = Mockery::mock(Role::class);

        $input = [
            'name' => 'admin',
        ];

        $expectedOutput = [
            'id' => 1,
            'name' => 'admin',
            'guard_name' => 'api',
            'created_at' => 'now',
            'updated_at' => 'now',
        ];

        $mockModel
            ->shouldReceive('create')
            ->with($input)
            ->andReturn($expectedOutput);

        $repository = new RoleEloquentRepository($mockModel);

        $output = $repository->create($input);

        $this->assertEquals($expectedOutput, $output);
        Mockery::close();
    }

    public function test_should_find_all(): void
    {
        $mockModel = Mockery::mock(Role::class);

        $expectedOutput = [
            [
                'id' => 1,
                'name' => 'admin',
                'guard_name' => 'api',
                'created_at' => 'now',
                'updated_at' => 'now',
            ],
            [
                'id' => 2,
                'name' => 'operator',
                'guard_name' => 'api',
                'created_at' => 'now',
                'updated_at' => 'now',
            ],
        ];

        $mockModel
            ->shouldReceive('where')
            ->andReturnSelf();

        $mockModel
            ->shouldReceive('get')
            ->andReturn($expectedOutput);

        $repository = new RoleEloquentRepository($mockModel);

        $output = $repository->findAll();

        $this->assertEquals($expectedOutput, $output);
        Mockery::close();
    }

    public function test_should_find_by_name(): void
    {
        $mockModel = Mockery::mock(Role::class);

        $input = [
            'name' => 'admin',
            'guard_name' => 'api',
        ];

        $expectedOutput = [
            'id' => 1,
            'name' => 'admin',
            'guard_name' => 'api',
            'created_at' => 'now',
            'updated_at' => 'now',
        ];

        $mockModel
            ->shouldReceive('where')
            ->andReturnSelf();

        $mockModel
            ->shouldReceive('first')
            ->andReturn($expectedOutput);

        $repository = new RoleEloquentRepository($mockModel);

        $output = $repository->findByName($input);

        $this->assertEquals($expectedOutput, $output);
        Mockery::close();
    }
}