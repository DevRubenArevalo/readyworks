<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    public function test(): array
    {
        return (new Computer)->test();
    }

    public function getTopTenComputerModels(): array
    {
        return (new Computer)->getTopTenComputerModels();
    }

    public function getOperatingSystemCounts(): array
    {
        return (new Computer)->getOperatingSystemCounts();
    }

    public function getLocationCounts(): array
    {
        return (new Computer)->getLocationCounts();
    }

    public function getDatatableSSP(Request $request): array
    {
        $inputs = $request->input();
        return (new Computer)->getDataTable($inputs);
    }

    public function getDataTableFormattedHtml(): string
    {
        return (new Computer)->getDataTableFormattedHtml();
    }

    public function resetDatabase()
    {
        (new Computer)->resetDatabase();
    }
}
