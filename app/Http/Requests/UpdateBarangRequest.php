<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\item;
use DB;

class UpdateBarangRequest extends FormRequest
{
    
    public function __construct()
    {
        $this->item = new item();
       
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules($id)
    {
        return [
                'nama_item' => 'required|unique:items,nama_item',
                'lokasi_item' => 'required',
                'jumlah_item' => 'required',
                'kondisi_item' => 'required',
                'deskripsi_item' => 'required',
        ];[
                'nama_item.required'=>'Nama Barang Wajib terisi',
                'lokasi_item.required'=>'Lokasi Barang Wajib terisi',
                'jumlah_item.required'=>'Jumlah Barang wajib terisi',
                'kondisi_item.required'=>'Kondisi Barang Wajib terisi',
                'deskripsi_item.required'=>'Deskripsi Barang wajib terisi',
        ];
    }
    public function messages()
    {
        return [
            'nama_item.required'=>'Nama Barang Wajib terisi',
            'lokasi_item.required'=>'Lokasi Barang Wajib terisi',
            'jumlah_item.required'=>'Jumlah Barang wajib terisi',
            'kondisi_item.required'=>'Kondisi Barang Wajib terisi',
            'deskripsi_item.required'=>'Deskripsi Barang wajib terisi',
        ] ;
    }
}
