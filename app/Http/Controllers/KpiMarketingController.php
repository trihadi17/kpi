<?php

namespace App\Http\Controllers;

use App\Models\KpiMarketing;
use Illuminate\Http\Request;

class KpiMarketingController extends Controller
{
    public function index(){

        // Soal No 1 (Sales, Report, KPI)
        $kpimarketing = KpiMarketing::selectRaw('
            karyawan AS Nama,
            2 AS Target_Sales,
            COUNT(CASE WHEN kpi = "Sales" THEN 1 END) AS Actual_Sales,
            CONCAT(ROUND(COUNT(CASE WHEN kpi = "Sales" THEN 1 END) * 100 / 2, 0), "%") AS Pencapaian_Sales,
            "50%" AS Bobot_Sales,
            CONCAT(CASE WHEN COUNT(CASE WHEN kpi = "Sales" AND aktual > deadline THEN 1 END) > 0 THEN -7 ELSE 0 END, "%") AS Late_Sales,
            CONCAT(ROUND(COUNT(CASE WHEN kpi= "Sales" THEN 1 END) * 50 / 2, 0), "%") AS Total_Bobot_Sales,

            COUNT(CASE WHEN kpi = "Report" THEN 1 END) AS Actual_Report,
            CONCAT(ROUND(COUNT(CASE WHEN kpi = "Report" THEN 1 END) * 100 / 2, 0), "%") AS Pencapaian_Report,
            "50%" AS Bobot_Report,
            CONCAT(CASE WHEN COUNT(CASE WHEN kpi = "Report" AND aktual > deadline THEN 1 END) > 0 THEN -5 ELSE 0 END, "%") AS Late_Report,
            CONCAT(ROUND(COUNT(CASE WHEN kpi= "Report" THEN 1 END) * 50 / 2, 0), "%") AS Total_Bobot_Report,

            CONCAT(ROUND(
            ((COUNT(CASE WHEN kpi= "Sales" THEN 1 END) * 50 / 2) + (COUNT(CASE WHEN kpi= "Report" THEN 1 END) * 50 / 2)) 
            +
            ((CASE WHEN COUNT(CASE WHEN kpi = "Sales" AND aktual > deadline THEN 1 END) > 0 THEN -7 ELSE 0 END) + (CASE WHEN COUNT(CASE WHEN kpi = "Report" AND aktual > deadline THEN 1 END) > 0 THEN -5 ELSE 0 END))
            ,0), "%") AS KPI
        ')
        ->groupBy('karyawan')
        ->orderBy('karyawan')
        ->get();

        // Soal No 2 (Jumlah Ontime/Late Beserta Persentase)
        $jumlahPersentase = KpiMarketing::selectRaw('
            COUNT(*) AS Total_Tasklist,
            COUNT(CASE WHEN aktual <= deadline THEN 1 END) AS Jumlah_Ontime,
            COUNT(CASE WHEN aktual > deadline THEN 1 END) AS Jumlah_Late,
            CONCAT(ROUND(COUNT(CASE WHEN aktual <= deadline THEN 1 END) * 100 / COUNT(*) ,2), "%") AS Persentase_Ontime,
            CONCAT(ROUND(COUNT(CASE WHEN aktual > deadline THEN 1 END) * 100 / COUNT(*) ,2), "%") AS Persentase_Late
        ')->first();

        return view('welcome', compact('kpimarketing','jumlahPersentase'));
    }
}
