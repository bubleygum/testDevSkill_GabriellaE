<?php

namespace App\Http\Controllers;
use App\Models\tableC;
use Illuminate\Http\Request;

class TableCController extends Controller
{
    public function destroy($id)
    {
        $record = tableC::findOrFail($id);
        $record->delete();
    
        return response()->json(['success' => 'Record deleted successfully!']);
    }
    
}
