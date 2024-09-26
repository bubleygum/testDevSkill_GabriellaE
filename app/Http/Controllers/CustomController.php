<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tableA;
use App\Models\tableB;
use App\Models\tableC;
use App\Models\tableD;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\DataTables;

class CustomController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function create(Request $request)
    {
        $request->validate([
            'kode_toko_baru' => 'required|numeric',
            'kode_toko_lama' => 'nullable|numeric',
        ]);
        tableA::create([
            'kode_toko_baru' => $request->kode_toko_baru,
            'kode_toko_lama' => $request->kode_toko_lama,
        ]);

        return redirect()->route('index')->with('success', 'Data created successfully!');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            $file = $request->file('file');
            $spreadsheet = IOFactory::load($file->getPathName());
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            foreach ($sheetData as $index => $row) {
                if ($index === 1)
                    continue;
                tableA::create([
                    'kode_toko_baru' => $row['A'],
                    'kode_toko_lama' => $row['B'] ?? null,
                ]);
            }

            return redirect()->route('index')->with('success', 'Data imported successfully!');
        } catch (\Exception $e) {
            return redirect()->route('index')->with('error', 'Failed to import data: ' . $e->getMessage());
        }
    }

    public function getTransaksiData()
    {
        $transaksi = tableA::leftJoin('table_b', 'table_a.kode_toko_baru', '=', 'table_b.kode_toko')
            ->select('table_a.kode_toko_baru', 'table_a.kode_toko_lama', 'table_b.nominal_transaksi')
            ->get();

        return DataTables::of($transaksi)
            ->addIndexColumn()
            ->make(true);
    }

    public function getTableAData()
    {
        $data = tableA::select('kode_toko_baru', 'kode_toko_lama');
        return DataTables::of($data)->make(true);
    }

    public function getTableBData()
    {
        $data = tableB::select('kode_toko', 'nominal_transaksi');
        return DataTables::of($data)->make(true);
    }

    public function getTableCData()
    {
        $data = tableC::select('kode_toko', 'area_sales');
        return DataTables::of($data)->make(true);
    }

    public function getTableDData()
    {
        $data = tableD::select('kode_sales', 'nama_sales');
        return DataTables::of($data)->make(true);
    }

    public function exportTableAPDF()
    {
        $data = tableA::all();
        $pdf = Pdf::loadView('exports.tableA', ['data' => $data]);
        return $pdf->download('table_a_data.pdf');
    }

    public function exportTableBPDF()
    {
        $data = tableB::all();
        $pdf = Pdf::loadView('exports.tableB', ['data' => $data]);
        return $pdf->download('table_b_data.pdf');
    }

    public function exportTableCPDF()
    {
        $data = tableC::all();
        $pdf = Pdf::loadView('exports.tableC', ['data' => $data]);
        return $pdf->download('table_c_data.pdf');
    }

    public function exportTableDPDF()
    {
        $data = tableD::all();
        $pdf = Pdf::loadView('exports.tableD', ['data' => $data]);
        return $pdf->download('table_d_data.pdf');
    }
    public function exportTableA()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Kode Toko Baru');
        $sheet->setCellValue('B1', 'Kode Toko Lama');
        $rows = tableA::all();
        $rowNumber = 2;
        foreach ($rows as $row) {
            $sheet->setCellValue('A' . $rowNumber, $row->kode_toko_baru);
            $sheet->setCellValue('B' . $rowNumber, $row->kode_toko_lama);
            $rowNumber++;
        }
        $fileName = 'table_a_data.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function exportTableB()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Kode Toko');
        $sheet->setCellValue('B1', 'Nominal Transaksi');
        $rows = tableB::all();
        $rowNumber = 2;
        foreach ($rows as $row) {
            $sheet->setCellValue('A' . $rowNumber, $row->kode_toko);
            $sheet->setCellValue('B' . $rowNumber, $row->nominal_transaksi);
            $rowNumber++;
        }
        $fileName = 'table_b_data.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function exportTableC()
    {
        $data = tableC::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Table C Data');
        $sheet->setCellValue('A1', 'Kode Toko');
        $sheet->setCellValue('B1', 'Area Sales');

        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item->kode_toko);
            $sheet->setCellValue('B' . $row, $item->area_sales);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'table_c_data.xlsx';

        return response()->stream(function () use ($writer) {
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }

    public function exportTableD()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Kode Sales');
        $sheet->setCellValue('B1', 'Nama Sales');

        $data = tableD::all();
        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item->kode_sales);
            $sheet->setCellValue('B' . $row, $item->nama_sales);
            $row++;
        }

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'table_d_data.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

    public function importTableC(Request $request)
    {
        $spreadsheet = IOFactory::load($request->file('file')->getRealPath());
        $data = $spreadsheet->getActiveSheet()->toArray();

        foreach ($data as $row) {
            if ($row[0] == 'Kode Toko')
                continue;
            tableC::updateOrCreate(
                ['kode_toko' => $row[0]],
                ['area_sales' => $row[1]]
            );
        }

        return redirect()->back()->with('success', 'Table C data imported successfully.');
    }

    public function importTableD(Request $request)
    {
        $spreadsheet = IOFactory::load($request->file('file')->getRealPath());
        $data = $spreadsheet->getActiveSheet()->toArray();

        foreach ($data as $row) {
            if ($row[0] == 'Kode Sales')
                continue;
            tableD::updateOrCreate(
                ['kode_sales' => $row[0]],
                ['nama_sales' => $row[1]]
            );
        }

        return redirect()->back()->with('success', 'Table D data imported successfully.');
    }

    public function storeTableC(Request $request)
    {
        $request->validate([
            'kode_toko' => 'required|numeric',
            'area_sales' => 'required|string|max:10',
        ]);

        tableC::updateOrCreate(
            ['kode_toko' => $request->kode_toko],
            ['area_sales' => $request->area_sales]
        );

        return redirect()->route('index')->with('success', 'Data saved successfully!');
    }

    public function storeTableD(Request $request)
    {
        $request->validate([
            'kode_sales' => 'required|string|max:255',
            'nama_sales' => 'required|string|max:20',
        ]);

        tableD::updateOrCreate(
            ['kode_sales' => $request->kode_sales],
            ['nama_sales' => $request->nama_sales]
        );

        return redirect()->route('index')->with('success', 'Data saved successfully!');
    }

    private function destroy($modelClass, $id)
    {
        $item = $modelClass::find($id);

        if ($item) {
            $item->delete();
            return response()->json(['success' => 'Item deleted successfully']);
        }

        return response()->json(['error' => 'Item not found'], 404);
    }

    public function deleteTableA($id)
    {
        return $this->destroy(tableA::class, $id);
    }

    public function deleteTableB($id)
    {
        return $this->destroy(tableB::class, $id);
    }

    public function deleteTableC($id)
    {
        return $this->destroy(tableC::class, $id);
    }

    public function deleteTableD($id)
    {
        return $this->destroy(tableD::class, $id);
    }

    public function pageTambahA()
    {
        return view('tambahA');
    }

    public function insertA(Request $request)
    {
        $request->validate([
            'kode_toko_baru' => 'required|string|max:255',
            'kode_toko_lama' => 'required|string|max:255',
        ]);
        tableA::create([
            'kode_toko_baru' => $request->kode_toko_baru,
            'kode_toko_lama' => $request->kode_toko_lama,
        ]);
        return redirect()->back()->with('success', 'Data added successfully.');
    }

    public function pageTambahB()
    {
        return view('tambahB');
    }
    public function insertB(Request $request)
    {
        $request->validate([
            'kode_toko' => 'required|string|max:255',
            'nominal_transaksi' => 'required|string|max:255',
        ]);
        tableB::create([
            'kode_toko' => $request->kode_toko_baru,
            'nominal_transaksi' => $request->kode_toko_lama,
        ]);
        return redirect()->back()->with('success', 'Data added successfully.');
    }
    public function pageTambahC()
    {
        return view('tambahC');
    }
    public function insertC(Request $request)
    {
        $request->validate([
            'kode_toko' => 'required|string|max:255',
            'area_sales' => 'required|string|max:255',
        ]);
        tableC::create([
            'kode_toko' => $request->kode_toko_baru,
            'area_sales' => $request->kode_toko_lama,
        ]);
        return redirect()->back()->with('success', 'Data added successfully.');
    }
    public function pageTambahD()
    {
        return view('tambahD');
    }
    public function insertD(Request $request)
    {
        $request->validate([
            'kode_sales' => 'required|string|max:255',
            'nama_sales' => 'required|string|max:255',
        ]);
        tableD::create([
            'kode_sales' => $request->kode_toko_baru,
            'nama_sales' => $request->kode_toko_lama,
        ]);
        return redirect()->back()->with('success', 'Data added successfully.');
    }
    public function storeExcelTableA(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048', // Validate the file
        ]);

        try {
            $spreadsheet = IOFactory::load($request->file('file')->getRealPath());
            $data = $spreadsheet->getActiveSheet()->toArray();

            foreach ($data as $row) {
                if (!empty($row[0])) {
                    tableA::create([
                        'kode_toko_baru' => $row[0],
                        'kode_toko_lama' => $row[1] ?? null,
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Data imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to import data: ' . $e->getMessage());
        }
    }
    public function storeExcelTableB(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            $spreadsheet = IOFactory::load($request->file('file')->getRealPath());
            $data = $spreadsheet->getActiveSheet()->toArray();

            foreach ($data as $row) {
                if (!empty($row[0])) {
                    tableA::create([
                        'kode_toko' => $row[0],
                        'nominal_transaksi' => $row[1] ?? null,
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Data imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to import data: ' . $e->getMessage());
        }
    }
    public function storeExcelTableC(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            $spreadsheet = IOFactory::load($request->file('file')->getRealPath());
            $data = $spreadsheet->getActiveSheet()->toArray();

            foreach ($data as $row) {
                if (!empty($row[0])) {
                    tableC::create([
                        'kode_toko' => $row[0],
                        'area_sales' => $row[1] ?? null,
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Data imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to import data: ' . $e->getMessage());
        }
    }
    public function storeExcelTableD(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            $spreadsheet = IOFactory::load($request->file('file')->getRealPath());
            $data = $spreadsheet->getActiveSheet()->toArray();

            foreach ($data as $row) {
                if (!empty($row[0])) {
                    tableD::create([
                        'kode_sales' => $row[0],
                        'nama_sales' => $row[1] ?? null,
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Data imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to import data: ' . $e->getMessage());
        }
    }
    public function editA($id)
    {
        $data = tableA::findOrFail($id); 
        return view('editA', compact('data')); 
    }

    public function updateTableA(Request $request, $id)
    {
        $request->validate([
            'kode_toko_baru' => 'required|string|max:255',
            'kode_toko_lama' => 'required|string|max:255',
        ]);

        $tableA = tableA::findOrFail($id);
        $tableA->update($request->only('kode_toko_baru', 'kode_toko_lama')); 

        return redirect()->back()->with('success', 'Data updated successfully!');
    }
    public function editD($id)
    {
        $data = tableD::findOrFail($id); 
        return view('editD', compact('data')); 
    }

    public function updateTableD(Request $request, $id)
    {
        $request->validate([
            'kode_sales' => 'required|string|max:255',
            'nama_sales' => 'required|string|max:255',
        ]);

        $tableD = tableD::findOrFail($id);
        $tableD->update($request->only('kode_sales', 'nama_sales')); 

        return redirect()->back()->with('success', 'Data updated successfully!');
    }
    public function editB($id)
    {
        $data = tableB::findOrFail($id); 
        return view('editB', compact('data')); 
    }

    public function updateTableB(Request $request, $id)
    {
        $request->validate([
            'kode_toko' => 'required|string|max:255',
            'nominal_transaksi' => 'required|string|max:255',
        ]);

        $tableB = tableB::findOrFail($id);
        $tableB->update($request->only('kode_toko', 'nominal_transaksi')); 

        return redirect()->back()->with('success', 'Data updated successfully!');
    }
    public function editC($id)
    {
        $data = tableC::findOrFail($id); 
        return view('editC', compact('data')); 
    }

    public function updateTableC(Request $request, $id)
    {
        $request->validate([
            'kode_toko' => 'required|string|max:255',
            'area_sales' => 'required|string|max:255',
        ]);

        $tableC = tableC::findOrFail($id);
        $tableC->update($request->only('kode_toko', 'area_sales')); 

        return redirect()->back()->with('success', 'Data updated successfully!');
    }

}
