<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToCollection, WithHeadingRow
{

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $row = $row->toArray();
            $row['password'] = Hash::make($row['phone']);
            $row['studing_status'] = 'continuous';
            $users[] = $row;
        }

        DB::transaction(function () use ($users) {
            foreach ($users as $user) {
                User::insert($user);
            }
        });
    }
}
