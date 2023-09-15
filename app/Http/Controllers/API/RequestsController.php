<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\Template;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestsController extends Controller
{
    // Отдаём заявки для сторонней CRM
    public function export(Request $request)
    {
        // Проверка на наличие токена
        if(!$request->has('token')) {
            return response('Unauthorized.', 401);
        }

        // Валидация
        $data = $request->validate([
            'token' => 'nullable|string|max:255',
            'from' => 'nullable|max:255',
        ]);

        $template = Template::where('token', $data['token'])->get();
        if($template->isEmpty()) {
            return response('Unauthorized.', 401);
        }

        // Получаем заявки
        $result = DB::table('requests')
            ->join('landings', 'landings.id', '=', 'requests.landing_id')
            ->join('templates', 'templates.id', '=', 'landings.template_id')
            ->where('templates.token', '=', $data['token'])
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
                    'referer' => isset($row->domain) ? (string) $row->domain : null,
                    'token' => isset($row->token) ? (string) $row->token : null,
                ];
            })
            ->toArray();

        return response()->json(array_values(array_merge($result)));
    }

    // Получаем заявки
    public function lead(Request $request)
    {
        // Валидация
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'landing_id' => 'nullable|numeric|min:1',
        ]);

        $data['fio'] = $data['name'];
        unset($data['name']);

        \App\Models\Request::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Заявка получена!',
        ],200);
    }
}
