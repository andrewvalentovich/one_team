<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    private $token;
    private $flats_token;

    public function __construct()
    {
        $this->token = config('app.token');
        $this->flats_token = config('app.flats_token');
    }

    public function request_export(Request $request)
    {
        if(!$request->has('token') || $request->token !== $this->token) {
            return response('Unauthorized.', 401);
        }

        // Получаем заявки
        $data = \App\Models\Request::query()
            ->where(function ($query) use ($request) {
                if($request->filled('from')) {
                    $query->where('created_at', '>', date('Y-m-d H:i:s', $request->from));
                }
            })
            ->get()
            ->transform(function ($row) {
                return [
                    'created' => (string) date('Y-m-d H:i:s', strtotime($row->created_at)),
                    'phone' => (string) $row->phone,
                    'first_name' => isset($row->fio) ? (string) $row->fio : null,
                    'last_name' => isset($row->last_name) ? (string) $row->last_name : null,
                    'middle_name' => isset($row->middle_name) ? (string) $row->middle_name : null,
                    'birthdate' => isset($row->birhday) ? (string) date('Y-m-d', strtotime($row->birhday)) : null,
                    'age' => isset($row->age) ? (int) $row->age : null,
                    'ip' => isset($row->ip) ? (string) $row->ip : null,
                    'utm_source' => isset($row->utm_source) ? (string) $row->utm_source : null,
                    'utm_medium' => isset($row->utm_medium) ? (string) $row->utm_medium : null,
                    'utm_campaign' => isset($row->utm_campaign) ? (string) $row->utm_campaign : null,
                    'utm_term' => isset($row->utm_term) ? (string) $row->utm_term : null,
                    'utm_content' => isset($row->utm_content) ? (string) $row->utm_content : null,
                    'referer' => isset($row->referer) ? (string) $row->referer : null,
                ];
            })
            ->toArray();

        return response()->json(array_values(array_merge($data)));
    }

    public function flats_request_export(Request $request)
    {
        if(!$request->has('token') || $request->token !== $this->flats_token) {
            return response('Unauthorized.', 401);
        }

        // Получаем заявки
        $data = \App\Models\FlatsRequest::query()
            ->where(function ($query) use ($request) {
                if($request->filled('from')) {
                    $query->where('created_at', '>', date('Y-m-d H:i:s', $request->from));
                }
            })
            ->get()
            ->transform(function ($row) {
                return [
                    'created' => (string) date('Y-m-d H:i:s', strtotime($row->created_at)),
                    'phone' => (string) $row->phone,
                    'first_name' => isset($row->first_name) ? (string) $row->first_name : null,
                    'last_name' => isset($row->last_name) ? (string) $row->last_name : null,
                    'middle_name' => isset($row->middle_name) ? (string) $row->middle_name : null,
                    'birthdate' => isset($row->birhday) ? (string) date('Y-m-d', strtotime($row->birhday)) : null,
                    'age' => isset($row->age) ? (int) $row->age : null,
                    'ip' => isset($row->ip) ? (string) $row->ip : null,
                    'utm_source' => isset($row->utm_source) ? (string) $row->utm_source : null,
                    'utm_medium' => isset($row->utm_medium) ? (string) $row->utm_medium : null,
                    'utm_campaign' => isset($row->utm_campaign) ? (string) $row->utm_campaign : null,
                    'utm_term' => isset($row->utm_term) ? (string) $row->utm_term : null,
                    'utm_content' => isset($row->utm_content) ? (string) $row->utm_content : null,
                    'referer' => isset($row->referer) ? (string) $row->referer : null,
                ];
            })
            ->toArray();

        return response()->json(array_values(array_merge($data)));
    }
}
