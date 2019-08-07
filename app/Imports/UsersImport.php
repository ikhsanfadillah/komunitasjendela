<?php

namespace App\Imports;

use Auth;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
    
        DB::beginTransaction();
        try{
        
            foreach ($rows as $row) 
            {
                if(!empty($row['name'])){

                    $user = User::create([
                        'name'  => $row['name'],
                        'email' => $row['email'],
                        'password' => Hash::make('1234567'),
                        'isActive' => 0,
                        'create_by' => Auth::id(),
                        'create_dt' => date('Y-m-d H:m:s'),
                        'edit_by' => Auth::id(),
                        'edit_dt' => Auth::id('Y-m-d H:m:s'),
                    ]);
                        
                    $userDetail = UserDetail::create([
                        'user_id' => $user->id,
                        'phone' =>$row['phone'],
                        'dob' => date('Y-m-d',strtotime($row['dob'])),
                    ]);
                }
            }
            DB::commit();
        }
        catch (Exception $e){
            DB::rollback();
            return $e->getMessage();
        }
    }
}
