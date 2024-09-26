<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tableA;
use App\Models\tableB;
use App\Models\tableC;
use App\Models\tableD;
use PDF;

class ExportController extends Controller
{
    public function exportAPDF()
    {
        $data = tableA::all();
        $pdf = PDF::loadView('pdf.tableA', compact('data'));
        return $pdf->download('tableA.pdf');
    }

    public function exportBPDF()
    {
        $data = tableB::all();
        $pdf = PDF::loadView('pdf.tableB', compact('data'));
        return $pdf->download('tableB.pdf');
    }

    public function exportCPDF()
    {
        $data = tableC::all();
        $pdf = PDF::loadView('pdf.tableC', compact('data'));
        return $pdf->download('tableC.pdf');
    }

    public function exportDPDF()
    {
        $data = tableD::all();
        $pdf = PDF::loadView('pdf.tableD', compact('data'));
        return $pdf->download('tableD.pdf');
    }
}
