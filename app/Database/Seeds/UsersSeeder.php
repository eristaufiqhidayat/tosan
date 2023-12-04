<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin',
            'email' => 'eristaufiq@gmail.com',
            'password_hash' => password_hash(base64_encode(hash('sha384', '123', true)), PASSWORD_DEFAULT),
            'created_at' => date("Y-m-d H:i:s"),
            'active' => '1',
        ];
        print_r($data);
        $this->db->table('users')->insert($data);
    }
}
