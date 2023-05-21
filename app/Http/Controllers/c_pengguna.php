<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\pengguna;
use DB;
use File;

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
            'level' => 'required',
            'password' => 'required',
        ],[
            'username.required'=>'Username Wajib Terisi',
            'username.unique'=>'Username Sudah Ada',
            'name.required'=>'Nama Wajib Terisi',
            'level.required'=>'Level Akun Wajib Terisi',
            'password.required'=>'Password Wajib Terisi',
        ]);

            if($request->foto <> null){
                $file = $request->foto;
                $filename = $request->username.'.png';   
                $file->move(public_path('foto/dm/pengguna'),$filename);
                $data = [
                    'username'=> $request->username,
                    'name'=> $request->name,
                    'level'=> $request->level,
                    'password'=> Hash::make($request->password),
                    'foto'=> $filename
                ];
                $this->pengguna->addData($data);
            }else{
                $data = [
                    'username'=> $request->username,
                    'name'=> $request->name,
                    'level'=> $request->level,
                    'password'=> Hash::make($request->password),
                    'foto'=> 'default.png'
                ];
                $this->pengguna->addData($data);
            }
          
            return redirect()->route('dm.pengguna.index')->with('success','Pengguna berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data =[
            'pengguna'=> $this->pengguna->detailData($id)
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
                'level'=> $request->level,
                'username'=> $request->username,
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

}