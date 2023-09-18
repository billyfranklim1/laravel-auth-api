<?php

namespace App\Http\Controllers\Webclin\RTP;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MonthlyConsolidatedController extends Controller
{
    public function listMonths(Request $request)
    {
         return response()->json(['data' => [[
            'id' => 1,
            'month' => 1,
            'month_name' => 'Janeiro',
            'unit_id' => 2,
            'unit_name' => 'UPA',
            'year' => '2023',
            'rtp_status_id' => 6,
            'status' => 'Finalizado',
            'created_at' => '2023-05-16 11:20:16',
            'updated_at' => '2023-05-16 11:20:16'
        ],
        [
            'id' => 1,
            'month' => 2,
            'month_name' => 'Fevereiro',
            'unit_id' => 2,
            'unit_name' => 'UPA',
            'year' => '2023',
            'status' => 'Relançamento',
            'rtp_status_id' => 6,
            'created_at' => '2023-05-16 11:20:16',
            'updated_at' => '2023-05-16 11:20:16'
        ],
        [
            'id' => 2,
            'month' => 1,
            'month_name' => 'Janeiro',
            'unit_id' => 2,
            'unit_name' => 'UPA',
            'year' => '2023',
            'status' => 'Aberto',
            'rtp_status_id' => 6,
            'created_at' => '2023-05-16 11:20:16',
            'updated_at' => '2023-05-16 11:20:16'
        ]],
        "links" => [
            "first" => "http:\/\/api-auth.emserh.local\/api\/system?page=1",
            "last" => "http:\/\/api-auth.emserh.local\/api\/system?page=1",
            "prev" => null,
            "next" => null
        ],
        "meta" => [
            "current_page" => 1,
            "from" => 1,
            "last_page" => 1,
            "links" => [
                [
                    "url" => null,
                    "label" => "&laquo; Previous",
                    "active" => false
                ],
                [
                    "url" => "http:\/\/api-auth.emserh.local\/api\/system?page=1",
                    "label" => "1",
                    "active" => true
                ],
                [
                    "url" => null,
                    "label" => "Next &raquo;",
                    "active" => false
                ]
            ],
            "path" => "http:\/\/api-auth.emserh.local\/api\/system",
            "per_page" => 10,
            "to" => 4,
            "total" => 4
        ]
    ]);
    }
}
