<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;

use App\Orcamento;
use App\Fornecedor;

use DB;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\WithEvents;


class OrcamentosExport implements FromQuery, WithMapping, WithHeadings, WithDrawings, WithEvents
{
    use Exportable;
    protected $orcamento;
    public function __construct($orcamento)
    {
        $this->orcamento = $orcamento; 
    }

    public function registerEvents(): array
    {
        
        $styleArray = [
            'font' => [
                'bold' => true,
            ]
        ];               


        return [
            // Handle by a closure.
            AfterSheet::class => function(AfterSheet $event){
                $event->sheet->setCellValue('A1', '');
            },
        ];
    }

    

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('ecardume');
        $drawing->setDescription('www.ecardume.com');
        $drawing->setPath(public_path('img/logo/logo-ecardume.png'));
        $drawing->setHeight(60);
        $drawing->setCoordinates('A1');

        return $drawing;
    }


    public function query(){

        $user = Auth::user();

        $fornecedor = $user->fornecedor()->first(); 

        $orcamento = Orcamento::where('fornecedor_id', $fornecedor->id)
                                ->where('id', $this->orcamento)
                                ->first();

        //$itens = ItemOrcamento::where('orcamento_id', $orcamento->id)->get();

        $itens = DB::table('item_orcamentos')
                ->select(array(
                    'item_orcamentos.id as item_id',
                    'item_orcamentos.quantidade',
                    'item_orcamentos.unidade_medida',
                    'item_orcamentos.preco',
                    'item_orcamentos.frete_preco',
                    'item_orcamentos.frete_tipo',
                    'item_orcamentos.moeda',
                    'produtos.*'
                 ))
                ->join('produtos', 'item_orcamentos.produto_id', '=', 'produtos.id')
                ->where('item_orcamentos.orcamento_id', $orcamento->id)                  
                ->orderBy('produtos.id', 'asc');



        return $itens;
    }

    public function map($itens):array
    {
        
        return [
            $itens->titulo,
            $itens->sku,
        ];
    }

    public function headings():array
    {
        return [
            'Título',
            'SKU'
        ];
    }

    


    

    
}








/*
class OrcamentosExport implements FromQuery
{    
    use Exportable;



    protected $id;

    public function __construct($id)
    {

        return $this->id = $id; 
    }

    public function map($orcamentos): array
    {
        return [
                'Custom text'.$orcamentos->codigo,
                $orcamentos->id,
        ];
    }

    public function headings(): array
    {
        return [
                'name',
                'email',
        ];
    }

    
    
}
*/

    /*public function collection()
    {
        $test  = $this->orcamento;
        return $test;
    }*/



    /*
    public function map(): array
    {
        
        dd($this->orcamento);

        return [
                'Custom text'.$orcamentos->codigo,
                $orcamentos->id,
        ];
    }
    */



    /*
    public function collection()
    {
        $test  = $this->orcamento;
        return $test;
    }
    */