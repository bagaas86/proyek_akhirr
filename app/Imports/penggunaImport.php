<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Hash;

// use Maatwebsite\Excel\Concerns\SkipsOnFailure;
// use Maatwebsite\Excel\Concerns\SkipsFailures;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;


class penggunaImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;
    // public function __construct()
    // {
    //     $this->pengguna = new pengguna();
       
    // }
    public function model(array $row)
    {

            $data = [
                'name' => $row['nama'],
                'username' => $row['username'],
                'no_identitas'=> $row['username'],
                'sebagai'=> $row['unit'],
                'foto' => "default.png",
                'password' => Hash::make($row['username']),
                'status_user' => "Aktif",
                // Add other fields as needed
            ];
    
            return new User($data);
    }


    public function rules(): array
    {
       return[
        'username' => [
            'required',
            Rule::unique('users', 'username'),
        ],
        ]; 
      
    }

    

    

}
