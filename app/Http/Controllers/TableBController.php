<?php

namespace App\Http\Controllers;
use App\Models\tableB;
use Illuminate\Http\Request;

class TableBController extends Controller
{
    public function destroy($id)
    {
        $record = tableB::findOrFail($id);
        $record->delete();

        return response()->json(['success' => 'Record deleted successfully!']);
    }

}
