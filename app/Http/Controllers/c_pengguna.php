<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\pengguna;
use DB;
use File;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\penggunaImport;
use Illuminate\Validation\ValidationException;

class c_pengguna extends Controller
{
    public function __construct()
    {
        $this->pengguna = new pengguna();
       
    }
    public function index()
    {
        $data =[
            'pengguna'=> $this->pengguna->allData()
        ];
        return view ('admin.pengguna.index', $data);
    }

    public function create()
    {
        return view ('admin.pengguna.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'name' => 'required',
            // 'level' => 'required',
            'password' => 'required',
            // 'id_unit' => 'required',
            'sebagai' => 'required',
        ],[
            'username.required'=>'Username Wajib Terisi',
            'username.unique'=>'Username Sudah Ada',
            'name.required'=>'Nama Wajib Terisi',
            // 'level.required'=>'Level Akun Wajib Terisi',
            'password.required'=>'Password Wajib Terisi',
            // 'id_unit.required'=>'Unit Wajib Terisi',
            'sebagai.required'=>'Sebagai Wajib Terisi',
        ]);

            if($request->foto <> null){
                $file = $request->foto;
                $filename = $request->username.'.png';   
                $file->move(public_path('foto/dm/pengguna'),$filename);
                $data = [
                    'username'=> $request->username,
                    'name'=> $request->name,
                    // 'level'=> $request->level,
                    'password'=> Hash::make($request->password),
                    'foto'=> $filename,
                    // 'id_unit'=> $request->id_unit,
                    'sebagai'=> $request->sebagai,
                    'status_user' => "Aktif",
                ];
                $this->pengguna->addData($data);
            }else{
                $data = [
                    'username'=> $request->username,
                    'name'=> $request->name,
                    // 'level'=> $request->level,
                    'password'=> Hash::make($request->password),
                    'foto'=> 'default.png',
                    // 'id_unit'=> $request->id_unit,
                    'sebagai'=> $request->sebagai,
                    'status_user' => "Aktif",
                ];
                $this->pengguna->addData($data);
            }
          
            return redirect()->route('dm.pengguna.index')->with('success','Pengguna berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data =[
            'pengguna'=> $this->pengguna->detailData($id),
            'sebagai' => $this->pengguna->sebagai(),
        ];
        return view ('admin.pengguna.edit', $data);
    }

    public function update(Request $request, $id)
    {
           // Ganti Foto
           if($request->foto <> null){
            $file = $request->foto;
            $filename= $request->username.".png";   
            $file->move(public_path('foto/dm/pengguna'),$filename);
            $data['foto'] = $filename;
            $this->pengguna->editData($id, $data);
        }

        if($request->password <> null){
            $data = [
                'password'=> Hash::make($request->password),
            ];
        }else{
            $data = [
                'name'=> $request->name,
                'sebagai'=> $request->sebagai,
                'username'=> $request->username,
                'keterangan'=> $request->keterangan,
                'no_identitas' => $request->no_identitas,
                'no_telepon' => $request->no_telepon,
            ];
           
        }
        $this->pengguna->editData($id, $data);

     
        return redirect()->route('dm.pengguna.index')->with('success', 'Pengguna Berhasil diupdate.');

    }

    public function destroy($id)
    {
        $deleteFoto = $this->pengguna->detailData($id);
        if($deleteFoto->foto <> "default.png"){
            File::delete('foto/dm/pengguna/'.$deleteFoto->foto);
        };

        $this->pengguna->deleteData($id);
        return redirect()->route('dm.pengguna.index')->with('success','Pengguna berhasil dihapus.');
    }

    public function import1(Request $request)
    {
        $file = $request->excel; 

        // $import = new penggunaImport;
        // $import->import($file);
        // // Excel::import(new penggunaImport, $file);
        // $failedRows = $import->getFailedRows();
        // if (!empty($failedRows)) {
        //     foreach ($failedRows as $failedRow) {
        //         $row = $failedRow['row'];
        //         $errors = $failedRow['errors'];
        //     }
        //     return redirect()->back()->with('error', $failedRows);
        // } else {
        //     return redirect()->back()->with('error');
        // }


        // if($import->failures()){
        //     return redirect()->back()->with('error', 'Terdapat Beberapa Username yang sama.');
        // }

        // return redirect()->back()->with('success','Import Data Pengguna Berhasil Dilakukan');
        
       
        try {
            Excel::import(new penggunaImport, $file);
        } catch (\Exception $e) {
            // Handle the exception (validation error)
            return redirect()->back()->with('error', 'Gagal import Excel file: Terjadi Kesamaan Pada Username.');
        }
        // $filename_excel = 'Akun'.'.'.$file->extension();   
        // $file->move(public_path('foto/dm/pengguna'),$filename_excel);  
        return redirect('dm/pengguna')->with('success', 'Import Data Pengguna Berhasil Dilakukan');
    }


    // user
    public function myProfil_User()
    {
        $id = Auth::user()->id;
        $data = [
            'pengguna'=> $this->pengguna->detailData($id),
        ];
        return view('user.v_profile', $data);
    }

    public function editProfil_User(Request $request)
    {
            $id = $request->id_user;
       
           // Ganti Foto
           if($request->foto <> null){
            $file = $request->foto;
            $filename= $request->username.".png";   
            $file->move(public_path('foto/dm/pengguna'),$filename);
            $data['foto'] = $filename;
            $this->pengguna->editData($id, $data);
        }

        if($request->password <> null){
            $data = [
                'password'=> Hash::make($request->password),
            ];
        }else{
            $data = [
                'name'=> $request->name,
                'sebagai'=> $request->sebagai,
                'username'=> $request->username,
                'keterangan'=> $request->keterangan,
                'no_identitas' => $request->no_identitas,
                'no_telepon' => $request->no_telepon,
            ];
           
        }
        $this->pengguna->editData($id, $data);
    
        return redirect()->route('profil.user')->with('success', 'Pengguna Berhasil diupdate.');

    }

}
