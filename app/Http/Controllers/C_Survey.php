<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_survey;

class C_Survey extends Controller
{
    public function index()
    {
        $survey = M_survey::allData();
        return view('survey.datasurvey', compact('survey'));
    }

    public function index2()
    {
        $survey = M_survey::dataAkun();
        return view('survey.v_tabelcalon', compact('survey'));
    }

    public function index3()
    {
        $survey = M_survey::dataProduk();
        return view('survey.v_laporansurvey', compact('survey'));
    }

    public function destroy($id_calon)
    {
        $data = M_survey::findOrFail($id_calon);
        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
