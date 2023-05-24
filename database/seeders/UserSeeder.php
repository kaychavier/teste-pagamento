<?php

namespace Database\Seeders;

use App\Repositories\UserRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->repository->createByRole([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('password')
        ], 'Admin');
    }
}
