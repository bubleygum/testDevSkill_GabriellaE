<?php

namespace App\Http\Controllers;
use App\Models\tableA;
use Illuminate\Http\Request;

class TableAController extends Controller
{
    public function destroy($id)
    {
        $record = tableA::findOrFail($id);
        $record->delete();

        return response()->json(['success' => 'Record deleted successfully!']);
    }

}
