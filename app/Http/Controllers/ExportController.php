<?php

namespace App\Http\Controllers;

use App\Exports\ProjectExport;
use App\Exports\RiskRankingExport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ExportController extends Controller
{
    public function export()
    {
        try{
            Log::info('Start exporting');
            $this->authorize('export');
            $fileName = 'document\risk-ranking-2023.xlsx';
            Excel::store(new RiskRankingExport(), $fileName);
            Log::info('Finish exporting');
            return response()->download(storage_path('app/document/risk-ranking-2023.xlsx'));
        } catch (\Exception $e){
            Log::error($e->getMessage());
            return response()->json($e->getMessage());
        }

    }
}
