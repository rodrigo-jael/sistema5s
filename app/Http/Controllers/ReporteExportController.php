<?php

namespace App\Http\Controllers;

use App\Exports\ReportesExport;
use Maatwebsite\Excel\Facades\Excel;

class ReporteExportController extends Controller
{
    public function export()
    {
        return Excel::download(new ReportesExport, 'reporte_5s.xlsx');
    }
}
