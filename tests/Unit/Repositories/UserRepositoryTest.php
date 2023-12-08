<?php

namespace Tests\Unit;

use App\Models\User;
use App\Repositories\UserRepository\UserEloquentRepository;
use Mockery;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    public function test_should_create_new_user(): void
    {
        $mockModel = Mockery::mock(User::class);

        $input = [
            'name' => 'Gabriel',
            'email' => 'test@gmail.com',
            'phone_number' => '11942421224',
            'password' => 'Test@20',
        ];

        $mockModel
            ->shouldReceive('create')
            ->andReturn($input);

        $userRepository = new UserEloquentRepository($mockModel);

        $output = $userRepository->create($input);

        $expectedOutput = $input;

        $this->assertEquals($expectedOutput, $output);

        Mockery::close();
    }

    public function test_should_find_user_by_email(): void
    {
        $mockModel = Mockery::mock(User::class);

        $output = [
            'id' => 1,
            'name' => 'Gabriel',
            'email' => 'test@gmail.com',
            'phone_number' => '11942421224',
        ];

        $email = 'test@gmail.com';

        $mockModel
            ->shouldReceive('where')
            ->with('email', $email)
            ->andReturnSelf();

        $mockModel
            ->shouldReceive('first')
            ->andReturn($output);

        $userRepository = new UserEloquentRepository($mockModel);

        $output = $userRepository->findByEmail($email);

        $expectedOutput = $output;

        $this->assertEquals($expectedOutput, $output);

        Mockery::close();
    }

    // public function test_should_create_access_token(): void
    // {
    //     $mockModel = Mockery::mock(User::class);

    //     $input = [
    //         'email' => 'test@gmail.com',
    //         'deviceName' => 'Postman',
    //     ];

    //     // $mockModel->shouldReceive('where')
    //     //     ->with('email', $input['email'])
    //     //     ->andReturnSelf();

        
    //     // $mockUser = Mockery::mock(User::class);
    //     // $mockModel->shouldReceive('first')
    //     //     ->andReturn($mockUser);

        

    //         $mockUser->shouldReceive('createToken')
    //         ->with($input['device_name'])
    //         ->andReturn((object) ['plainTextToken' => 'test-token']);

    //     $userRepository = new UserEloquentRepository($mockModel);

    //     $output = $userRepository->createAccessToken($input['email'], $input['deviceName']);

    //     $expectedOutput = 'test-token';

    //     $this->assertEquals($expectedOutput, $output);

    //     Mockery::close();
    // }
}
