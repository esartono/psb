<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCalonRequest extends FormRequest
{
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
     * @return array
     */
    public function rules()
    {
        return [
            'nik' => 'required|integer|unique:calons',
            'name' => 'required',
            'panggilan' => 'required',
            'jk' => 'required',
            'kelas_tujuan' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'agama' => 'required',
            'info' => 'required',
            'alamat' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'phone' => 'required',
            'ayah_nama' => 'required',
            'ayah_pendidikan' => 'required',
            'ayah_pekerjaan' => 'required',
            'ayah_penghasilan' => 'required',
            'ibu_nama' => 'required',
            'ibu_pendidikan' => 'required',
            'ibu_pekerjaan' => 'required',
            'asal_sekolah' => 'required',
        ];
    }

    public function messages()
    {
        $kudu = 'Harus diisi dengan ';
        return [
            'nik.required' => ['No. NIK' ,$kudu.'No. Induk Kependudukan.'],
            'nik.unique' => ['No. NIK', 'Sudah terdaftar'],
            'name.required' => ['Nama' ,$kudu.'Nama Lengkap.'],
            'panggilan.required' => ['panggilan' ,$kudu.'Panggilan'],
            'jk.required' => ['Jenis Kelamin' ,'Pilih Jenis Kelamin'],
            'kelas_tujuan.required' => ['Kelas' ,$kudu.'Kelas Tujuan'],
            'tempat_lahir.required' => ['Tempat Lahir' ,$kudu.'Tempat Kelahiran'],
            'tgl_lahir.required' => ['Tanggal Lahir' ,$kudu.'Tanggal Lahir'],
            'agama.required' => ['Agama' ,'Pilih Agama'],
            'info.required' => ['Informasi' ,'Pilih Sumber Informasi'],
            'alamat.required' => ['Alamat' ,$kudu.'Alamat tempat tinggal'],
            'provinsi.required' => ['Provinsi' ,'Pilih Provinsi'],
            'kota.required' => ['Kota/Kabupaten' ,'Pilih Kota/Kabupaten'],
            'kecamatan.required' => ['Kecamatan' ,'Pilih Kecamatan'],
            'kelurahan.required' => ['Kelurahan' ,'Pilih Kelurahan'],
            'rt.required' => ['RT' ,$kudu.'No. RT'],
            'rt.integer' => ['RT' ,$kudu.'Angka'],
            'rw.required' => ['RW' ,$kudu.'No. RW'],
            'rw.integer' => ['RW' ,$kudu.'Angka'],
            'phone.required' => ['Handphone' ,$kudu.'No. Handphone'],
            'ayah_nama.required' => ['Nama Ayah' ,$kudu.'Nama Ayah'],
            'ayah_pendidikan.required' => ['Pendidikan Ayah' ,'Pilih Pendidikan'],
            'ayah_pekerjaan.required' => ['Pekerjaan Ayah' ,'Pilih Pekerjaan'],
            'ayah_penghasilan.required' => ['Penghasilan Ayah' ,'Pilih Penghasilan'],
            'ibu_nama.required' => ['Nama Ibu' ,$kudu.'Nama Ibu'],
            'ibu_pendidikan.required' => ['Pendidikan Ibu' ,'Pilih Pendidikan'],
            'ibu_pekerjaan.required' => ['Pekerjaan Ibu' ,'Pilih Pekerjaan'],
            'asal_sekolah.required' => ['Asal Sekolah', 'Jika tidak ada isi dengan `Tidak Ada`']
        ];
    }
}
