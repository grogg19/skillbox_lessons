<?php

namespace App\Http\Controllers;

use App\Services\PushAll;
use Illuminate\Http\Request;

class PushServiceController extends Controller
{
    public function form()
    {
        return view('pushall.service');
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:80',
            'text' => 'required|max:500'
        ]);

        push_all($data['title'], $data['text']);

        return redirect(route('pushall.form'))
            ->with('status', 'Уведомление успешно отправлено');
    }
}
