<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PdfController extends Controller
{
    public function pdfQrAll()
    {
        $alumnos = Alumno::select('id', 'nombre_alumno', 'apellido_alumno',
            DB::RAW("0 as code"))->get();
        foreach ($alumnos as $i) {
            $i->code = base64_encode(QrCode::format('png')->size(150)->generate(route('alumno.qr', $i->id)));
           // $i->code = QrCode::format('png')->size(150)->generate(route('alumno.qr', $i->id));
        }
    

        $pdf = PDF::loadView('pdf.pdf-qr-all', compact('alumnos'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('alumnos-qr-all.pdf');
    }
}
