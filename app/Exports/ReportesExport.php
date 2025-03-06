<?php

namespace App\Exports;

use App\Models\Evaluation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        // Aquí seleccionamos las evaluaciones agrupadas por fecha
        return Evaluation::with('employee')  // Asumimos que la relación está definida en el modelo Evaluation
            ->select('evaluation_date', 'employee_id', 'evaluation_5s')  // Seleccionamos las columnas relevantes
            ->orderBy('evaluation_date')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Fecha',
            'Total Evaluaciones',
            'Total Cumplió',
            'Total No Cumplió',
            'Porcentaje Cumplió',
            'Porcentaje No Cumplió',
            'Empleado con Menor Cumplimiento',
            'Estrategias de Mejora',
        ];
    }

    public function map($evaluation): array
    {
        // Agrupar las evaluaciones por fecha
        $evaluationsGrouped = Evaluation::where('evaluation_date', $evaluation->evaluation_date)->get();

        $totalEvaluaciones = $evaluationsGrouped->count();
        $totalCumplio = $evaluationsGrouped->where('evaluation_5s', 'cumplio')->count();
        $totalNoCumplio = $evaluationsGrouped->where('evaluation_5s', 'no_cumplio')->count();

        $porcentajeCumplio = $totalEvaluaciones > 0 ? round(($totalCumplio / $totalEvaluaciones) * 100, 2) : 0;
        $porcentajeNoCumplio = $totalEvaluaciones > 0 ? round(($totalNoCumplio / $totalEvaluaciones) * 100, 2) : 0;

        // Empleado con menor cumplimiento (puedes modificar esto según lo que necesites)
        $empleadoMenosCumplio = $evaluationsGrouped->where('evaluation_5s', 'no_cumplio')->first()->employee->name ?? 'N/A';

        // Estrategias (esto también puedes cambiarlo según tus necesidades)
        $estrategias = 'No se requieren estrategias adicionales';  // Ajustar según tus necesidades

        return [
            $evaluation->evaluation_date,
            $totalEvaluaciones,
            $totalCumplio,
            $totalNoCumplio,
            "{$porcentajeCumplio}%",
            "{$porcentajeNoCumplio}%",
            $empleadoMenosCumplio,
            $estrategias,
        ];
    }
}
