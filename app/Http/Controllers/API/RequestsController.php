<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\SendRequestRequest;
use App\Models\Request as Req;
use App\Models\Template;
use http\Client\Response;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestsController extends Controller
{
    // Отдаём заявки для сторонней CRM
    public function export(Request $request) : mixed
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


        if ($data['token'] === config('app.token')) {
            return response()->json(array_values(array_merge($this->export_default($data))));
        } elseif ($data['token'] === config('app.templates_token')) {
            return response()->json(array_values(array_merge($this->export_templates_all($data))));
        } else {
            $template = Template::where('token', $data['token'])->get();
            if($template->isEmpty()) {
                return response('Unauthorized.', 401);
            }

            return response()->json(array_values(array_merge($this->export_template($data))));
        }
    }

    private function export_template(array $data) : mixed
    {
        // Получаем заявки
        $result = DB::table('requests')
            ->join('landings', 'landings.id', '=', 'requests.landing_id')
            ->join('templates', 'templates.id', '=', 'landings.template_id')
            ->where('templates.token', '=', $data['token'])
            ->where(function ($query) use ($data) {
                if(isset($data['from'])) {
                    $query->where('requests.created_at', '>', date('Y-m-d H:i:s', $data['from']));
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
                    'referer' => isset($row->domain) ? (string) $row->domain : null,
                    'token' => isset($row->token) ? (string) $row->token : null,
                ];
            })
            ->toArray();

        return $result;
    }

    private function export_default(array $data) : array
    {
        // Получаем заявки
        $result = DB::table('requests')
            ->whereNull('landing_id')
            ->where(function ($query) use ($data) {
                if(isset($data['from'])) {
                    $query->where('created_at', '>', date('Y-m-d H:i:s', $data['from']));
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
                    'token' => isset($row->token) ? (string) $row->token : null,
                ];
            })
            ->toArray();

        return $result;
    }

    private function export_templates_all(array $data) : array
    {
        // Получаем заявки
        $result = DB::table('requests')
            ->join('landings', 'landings.id', '=', 'requests.landing_id')
            ->join('templates', 'templates.id', '=', 'landings.template_id')
            ->whereNotNull('templates.token')
            ->where(function ($query) use ($data) {
                if(isset($data['from'])) {
                    $query->where('requests.created_at', '>', date('Y-m-d H:i:s', $data['from']));
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
                    'referer' => isset($row->domain) ? (string) $row->domain : null,
                    'token' => isset($row->token) ? (string) $row->token : null,
                ];
            })
            ->toArray();

        return $result;
    }

    // Сохраняем заявки
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

    public function getRequest(SendRequestRequest $request)
    {
        $data = $request->validated();

        // Обработка страны
        if (isset($data['country'])) {
            $data['country'] = strip_tags($data['country']);
            $position = strrpos($data['country'], ')');
            if ($position !== false) {
                $data['country'] = substr($data['country'], 0, $position + 1);
            }
        }

//        Mail::to('one.team.dev.1@gmail.com')->send(new SendRequestFromAdmin($details));
//        try{
//        }catch (\Exception $e){
//            return response()->json([
//                'status' => false,
//                'message' => 'email error'
//            ],422);
//        }

        Req::create($data);

        $message = __('Мы получили ваше сообщение наш сотрудник скоро свяжется с вами');

        return response()->json([
            'status' => true,
            'message' => $message
        ],200);
    }

    public function test(Request $request)
    {
        // Валидация
        $data = $request->validate([
            'token' => 'nullable|string|max:255',
            'from' => 'nullable|max:255',
        ]);

        dump(date('Y-m-d H:i:s', $data['from']));

        // Получаем заявки
        $result = DB::table('requests')
            ->whereNull('landing_id')
            ->where(function ($query) use ($data) {
                if(isset($data['from'])) {
                    $query->where('created_at', '>', date('Y-m-d H:i:s', $data['from']));
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
                    'referer' => isset($row->domain) ? (string) $row->domain : null,
                    'token' => isset($row->token) ? (string) $row->token : null,
                ];
            })
            ->toArray();

        dd($result);
    }
}
