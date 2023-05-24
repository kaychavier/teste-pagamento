<?php

namespace Database\Seeders;

use App\Repositories\RolePermissionRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function __construct(private readonly RolePermissionRepository $repository)
    {
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seller_permissions = collect(['list client', 'show client', 'create client', 'update client', 'delete client', 'list product', 'show product', 'create product', 'update product', 'delete product', 'list purchase', 'show purchase', 'create purchase', 'update purchase', 'delete purchase']);
        $seller_permissions->each(function ($p) {
            $this->repository->firstOrCreateByNames('Seller', $p);
            $this->repository->firstOrCreateByNames('Admin', $p);
        });
        $admin_permissions = collect(['list user', 'show user', 'create user', 'update user', 'delete user', 'list role', 'show role', 'create role', 'update role', 'delete role', 'admin resources']);
        $admin_permissions->each(fn ($p) => $this->repository->firstOrCreateByNames('Admin', $p));
    }
}
