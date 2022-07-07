<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Computer extends Model
{
    protected $table = 'computer';

    public function test(): array
    {
        return ['Test!'];
    }

    public function getTopTenComputerModels(): array
    {

        $computerModels = DB::table('computer')
            ->select(
                DB::raw('computer_model as "Computer Model"'),
                DB::raw('count(*) as "Count"')
            )
            ->groupBy('computer_model')
            ->orderByDesc(DB::raw('Count'))
            ->limit(10)
            ->get()
            ->toArray();

        return $computerModels ?? [];
    }

    public function getOperatingSystemCounts(): array
    {
        $operatingSystems = DB::table('computer')
            ->select(
                DB::raw('operating_system as "Operating System"'),
                DB::raw('count(*) as "Count"')
            )
            ->groupBy('operating_system')
            ->orderByDesc(DB::raw('Count'))
            ->limit(10)
            ->get()
            ->toArray();

        return $operatingSystems ?? [];
    }

    public function getLocationCounts(): array
    {
        $locationCounts = DB::table('computer')
            ->select(
                DB::raw('location as "Location"'),
                DB::raw('count(*) as "Count"')
            )
            ->groupBy('Location')
            ->orderByDesc(DB::raw('Count'))
            ->limit(10)
            ->get()
            ->toArray();

        return $locationCounts ?? [];
    }

    public function getComputerData($limit = 0, $offset = 0, $filter = ''): array
    {
        $computers = DB::table('computer')
            ->select('*');

        $totalRows = $computers->count();

        // Filtering
        if ($filter != '') {
            $columns = $this->getHeaders();
            foreach ($columns as $column) {
                $computers->orWhere($column, 'LIKE', "%$filter%");
            }
        }

        $totalFiltered = $computers->count();

        // Pagination chunking
        if ($limit > 0) {
            $computers->limit($limit);
        }

        if ($offset > 0) {
            $computers->offset($offset);
        }

        $rows = $computers->get()->toArray();

        $values = [];
        $columns = array_keys((array)current($rows));
        foreach ($rows as $row) {
            $values[] = array_values((array)$row);
        }

        return [
                'columns' => $columns,
                'values' => $values,
                'totalRows' => $totalRows,
                'totalFilteredRows' => $totalFiltered
            ] ?? [];
    }

    private function getHeaders(): array
    {
        $headers = DB::table('computer')->select('*')->limit(1)->get()->toArray();
        $tmp = (array)$headers[0];
        return array_keys($tmp);
    }

    public function getDataTableFormattedHtml(): string
    {
        $html = '<thead><tr>';
        $headers = $this->getHeaders();
        foreach ($headers as $header) {
            $html .= "<th>$header</th>";
        }

        $html .= '</tr></thead>';

        return $html;
    }

    public function getDataTable($inputs): array
    {
        $computerData = $this->getComputerData($inputs['length'], $inputs['start'], $inputs['search']['value']);

        return [
            'draw' => intval($inputs['draw']) ?? 0,
            "recordsTotal" => intval($computerData['totalRows']) ?? 0,
            "recordsFiltered" => intval($computerData['totalFilteredRows']) ?? 0,
            "data" => $computerData['values']
        ];
    }

    public function getDepartments(): array
    {
        $departments = DB::table('computer')
            ->distinct()
            ->select('department')
            ->get()
            ->pluck('department')
            ->toArray();
        return $departments;
    }

    public function getComputerModels(): array
    {
        $computerModels = DB::table('computer')
            ->distinct()
            ->select('computer_model')
            ->get()
            ->pluck('computer_model')
            ->toArray();
        return $computerModels;
    }

    public function resetDatabase()
    {
        // Only table relative to reset is the computer table. Resetting table only.
        Schema::dropIfExists('computer');
        DB::unprepared(file_get_contents('../database/readyworks_db.sql'));
    }
}
