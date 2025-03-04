<?php

// app/Exports/ReportesExport.php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $fechas;
    protected $totalEvaluaciones;
    protected $totalCumplio;
    protected $totalNoCumplio;
    protected $porcentajeCumplio;
    protected $porcentajeNoCumplio;
    protected $empleadoMasCumplidor;

    public function __construct($fechas, $totalEvaluaciones, $totalCumplio, $totalNoCumplio, $porcentajeCumplio, $porcentajeNoCumplio, $empleadoMasCumplidor)
    {
        $this->fechas = $fechas;
        $this->totalEvaluaciones = $totalEvaluaciones;
        $this->totalCumplio = $totalCumplio;
        $this->totalNoCumplio = $totalNoCumplio;
        $this->porcentajeCumplio = $porcentajeCumplio;
        $this->porcentajeNoCumplio = $porcentajeNoCumplio;
        $this->empleadoMasCumplidor = $empleadoMasCumplidor;
    }

    public function collection()
    {
        // Creamos un arreglo con los datos que quieres exportar
        return collect([
            ['Fecha', 'Total Evaluaciones', 'Total Cumplió', 'Total No Cumplió', 'Porcentaje Cumplió', 'Porcentaje No Cumplió', 'Empleado Más Cumplidor'],
            [$this->fechas->implode(', '), $this->totalEvaluaciones, $this->totalCumplio, $this->totalNoCumplio, $this->porcentajeCumplio . '%', $this->porcentajeNoCumplio . '%', $this->empleadoMasCumplidor]
        ]);
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
            'Empleado Más Cumplidor'
        ];
    }

    public function map($row): array
    {
        return [
            $row[0], 
            $row[1], 
            $row[2], 
            $row[3], 
            $row[4], 
            $row[5], 
            $row[6]
        ];
    }
}
