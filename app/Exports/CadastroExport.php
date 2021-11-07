<?php

namespace App\Exports;

use App\Cadastro;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class CadastroExport extends BaseExport implements FromCollection,  ShouldAutoSize, WithHeadings, WithMapping,
    WithColumnFormatting
{
    /**
     * Esta propriedade armazena a coleção de dados que serão impressos da planilha
     *
     * @var Collection $collection
     */
    protected $collection;

    /**
     * Cria uma nova instância desta classe. Recebe como parâmetro uma coleção que será usada para alimentar a planilha
     *
     * ProjetoExport constructor.
     * @param $collection
     */
    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    /**
     * Retorna a coleção de dados para a planilha
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->collection;
    }

    /**
     * Informa qual o cabeçalho da planilha
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            [
                'A' => 'CADASTROS',
                ''
            ],
            [
                'A' => 'ID',
                'B' => 'Nome',
                'C' => 'Email',
                'D' => 'Telefone',
                'E' => 'Mensagem',
                'F' => 'Arquivo',
                'G' => 'IP',
                'H' => 'Total Gostei',
                'I' => 'Total Não Gostei',
                'J' => 'Total Visualização',
                'K' => 'Data Criação'
            ]
        ];
    }

    /**
     * Trata os dados que serão impressos da planilha. Ex: conversões para tipos excel
     *
     * @param mixed $row
     * @return array
     * @throws \Exception
     */
    public function map($row): array
    {
        return [
            'A' => $row->id,
            'B' => $row->name,
            'C' => $row->email,
            'D' => $row->telephone,
            'E' => $row->message,
            'F' => $row->file,
            'G' => $row->ip_address,
            'H' => $row->total_gostei ?? '0',
            'I' => $row->total_naogostei ?? '0',
            'J' => $row->total_visualizacao ?? '0',
            'K' => $this->dateOrNull($row->created_at)
        ];
    }

    /**
     * Formata os tipos de dados das colunas
     *
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'K' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
