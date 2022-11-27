<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class permissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'role' => ['add','edit','view','delete'],
            'permission' => ['add','edit','view','delete'],
            'user' => ['add','edit','view','delete'],
            'catagories' => ['add','edit','view','delete'],
            'products' => ['add','edit','view','delete'],
        ];
        
        DB::table('permissions')->insert([  
            'role_id' => 1,
            'permissions' => json_encode($roles),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        
    }
}
