<?php

namespace App\Exports;

use App\Orcamento;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;





class OrcamentosExportView implements FromView
{
    public function view(): View
    {
        return view('fornecedor_area.orcamento_show_excel', [
            'customers' => Orcamento::all()
        ]);
    }
}
