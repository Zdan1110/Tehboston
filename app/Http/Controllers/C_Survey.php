<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_survey;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class C_Survey extends Controller
{

    public function __construct()
    {
        $this->M_survey = new M_survey();
    }

    public function index()
    {
        $survey = $this->M_survey->allData();
        return view('survey.datasurvey', compact('survey'));
    }

    public function index2()
    {
        $survey = $this->M_survey->dataAkun();
        return view('survey.v_tabelcalon', compact('survey'));
    }

    public function index3($id_calon)
    {
        $data = $this->M_survey->buatlaporan($id_calon);
        return view('survey.v_laporansurvey', compact('data'));
    }

    public function destroy($id_calon)
    {
        $data = $this->M_survey->findOrFail($id_calon);
        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function laporansurvey(Request $request, $id_calon)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'panjang' => 'required',
            'lebar' => 'required',
            'total_luas' => 'required',
            'foto' => 'required|file|mimes:jpg,jpeg,png,pdf',
            'catatan' => 'required',
        ]);
        
        $lastsurvey = DB::table('tb_survey')
        ->select('id_survey')
        ->orderByDesc('id_survey')
        ->first();

        if ($lastsurvey) {
        $lastNumsurvey = (int) substr($lastsurvey->id_survey, 1); 
        $idsurvey = 'S' . str_pad($lastNumsurvey + 1, 4, '0', STR_PAD_LEFT);
        } else {
        $idsurvey = 'S0001';    
        }

        $filesurvey = Request()->file('foto');
        $fileNamesurvey = $idsurvey . '.' . $filesurvey->extension();
        $filesurvey->move(public_path('uploads/survey'), $fileNamesurvey);

        $datacalon = DB::table('tb_calonmitra')->where('id_calon', $id_calon)->first();

        $datasurvey = [
            'id_survey' => $idsurvey,
            'id_calon' => $request->id_calon,
            'id_akun' => $request->id_akun,
            'nama_lengkap' => $datacalon->nama_lengkap,
            'panjang' => $request->panjang,
            'lebar' => $request->lebar,
            'total_luas' => $request->total_luas,
            'foto' => $fileNamesurvey,
            'catatan' => $request->catatan,
        ];

        try {
            DB::table('tb_survey')->insert($datasurvey);
            Log::info('Data survey berhasil disimpan.', $datasurvey);

            return redirect('/datasurvey')->with('success', 'Buat Laporan Berhasil!.');
        } catch (\Exception $e) {
            Log::error('Gagal membuat laporan: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat laporan. Silakan coba lagi.');
        }
    }
}
