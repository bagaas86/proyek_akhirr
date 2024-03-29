<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\pengguna;
use App\Models\unit;
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
        $this->unit = new unit();
       
    }
    public function index()
    {
        $akun = Auth::user()->sebagai;
        
        if($akun == "Admin"){
            $data =[
                'pengguna'=> $this->pengguna->getData()
            ];  
        }else{
            $data =[
                'pengguna'=> $this->pengguna->allData()
            ];
        }
      
        return view ('admin.pengguna.index', $data);
    }

    public function create()
    {
        $data = [
            'unit' => $this->unit->unitData()
        ];
        return view ('admin.pengguna.create', $data);
    }
    
    public function store(Request $request)
    {
        $akun = Auth::user()->sebagai;
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
                    'keterangan'=> $request->sebagai,
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
                    'keterangan'=> $request->sebagai,
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
            'unit' => $this->unit->unitData(),
            'tambahan' => $this->unit->allData()
        ];
        return view ('admin.pengguna.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validate = $this->pengguna->detailData($id);
        if($request->username <> $validate->username)
        {
            $request->validate([
                'username' => 'required|unique:users,username',
                'name' => 'required',
            ],[
                'username.required'=>'Username Wajib Terisi',
                'username.unique'=>'Username Sudah Ada',
                'name.required'=>'Nama Wajib Terisi',
            ]);
        }else{
            $request->validate([
                'username' => 'required',
                'name' => 'required',
            ],[
                'username.required'=>'Username Wajib Terisi',
                'username.unique'=>'Username Sudah Ada',
                'name.required'=>'Nama Wajib Terisi',
            ]);
        }
      

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
                'username'=> $request->username,
                'no_identitas' => $request->no_identitas,
                'no_telepon' => $request->no_telepon,
                'keterangan' => $request->keterangan,
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
        // $this->pengguna->deleteData($id);

        $data = [
            'username' => null,
            'status_user' => $deleteFoto->username,
        ];
        $this->pengguna->editData($id, $data);

        return redirect()->route('dm.pengguna.index')->with('success','Pengguna berhasil dihapus.');
    }

    public function tambahTugas($id)
    {
        $data = [
            'pengguna'=> $this->pengguna->detailData($id),
            'tambahan' => $this->unit->jabatanData()
        ];

        return view('admin.pengguna.tambahtugas', $data);
    }

    public function tambahTugasUpdate(Request $request, $id)
    {
        $data = [
            'sebagai' => $request->sebagai,
        ];
        $this->pengguna->editData($id, $data);
        return redirect()->route('dm.pengguna.index')->with('success', 'Pengguna Berhasil diupdate.');
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
        
        // Excel::import(new penggunaImport, $file, 'Sheet1');
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
            'tambahan' => $this->unit->jabatanData()
        ];
        return view('user.v_profile', $data);
    }

    public function editProfil_User(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'foto' => 'mimes:jpg,png',
            'no_telepon' => [
                function ($attribute, $value, $fail) {
                    if (strpos($value, '+62') === 0) {
                        $fail('Nomor telepon tidak boleh diisi dengan +62.');
                    }
                },
            ],
        ],[
            'name.required'=>'Nama Tidak Boleh Kosong.',
            'foto.mimes'=>'Foto Harus Berformat JPG atau PNG.',
            'no_telepon' => 'Nomor telepon tidak boleh diisi dengan +62.'
        ]);
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
                'jenis_identitas'=>$request->jenis_identitas,
            ];
           
        }
        $this->pengguna->editData($id, $data);
    
        return redirect()->route('profil.user')->with('success', 'Pengguna Berhasil diupdate.');

    }


     // user
     public function myProfil_Admin()
     {
         $id = Auth::user()->id;
         $data = [
             'pengguna'=> $this->pengguna->detailData($id),
             'tambahan' => $this->unit->jabatanData()
         ];
         return view('user.v_adm_profile', $data);
     }
 
     public function editProfil_Admin(Request $request)
     {

             $request->validate([
                'name' => 'required',
                'foto' => 'mimes:jpg,png',
                'no_telepon' => [
                    function ($attribute, $value, $fail) {
                        if (strpos($value, '+62') === 0) {
                            $fail('Nomor telepon tidak boleh diisi dengan +62.');
                        }
                    },
                ],
            ],[
                'name.required'=>'Nama Tidak Boleh Kosong.',
                'foto.mimes'=>'Foto Harus Berformat JPG atau PNG.',
                'no_telepon' => 'Nomor telepon tidak boleh diisi dengan +62.'
            ]);

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
                 'jenis_identitas'=>$request->jenis_identitas,
             ];
            
         }
         $this->pengguna->editData($id, $data);
     
         return redirect()->route('profil.admin')->with('success', 'Pengguna Berhasil diupdate.');
 
     }

}
