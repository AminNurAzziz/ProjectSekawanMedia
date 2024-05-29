<?php

namespace App\Repositories;

use App\Models\HeadOfficeManager;
use App\Interfaces\HeadOfficeManagerRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class HeadOfficeManagerRepository implements HeadOfficeManagerRepositoryInterface
{
    public function create(array $data)
    {
        $account = User::create([
            'username' => $data['Name'],
            'email' => $data['Name'] . '@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'approver2'
        ]);
        $data = HeadOfficeManager::create($data);
        $data->UserID = $account->id;
        $data->save();
        return $data;
    }

    public function update(array $data, $id)
    {
        $manager = HeadOfficeManager::findOrFail($id);
        $manager->update($data);
        return $manager;
    }

    public function delete($id)
    {
        return HeadOfficeManager::destroy($id);
    }

    public function find($id)
    {
        return HeadOfficeManager::findOrFail($id);
    }

    public function all()
    {
        return HeadOfficeManager::all();
    }
}
