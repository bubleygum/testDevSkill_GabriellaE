<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tableD;
class TableDController extends Controller
{
    public function destroy($id)
    {
        $record = tableD::findOrFail($id);
        $record->delete();

        return response()->json(['success' => 'Record deleted successfully!']);
    }

}
