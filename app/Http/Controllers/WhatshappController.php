<?php

namespace App\Http\Controllers;

use App\Helpers\MqttHelper;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Models\UserChat;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WhatshappController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $userChat = UserChat::where('user_id', Auth::user()->id )->orWhere('sendto_userid', Auth::user()->id )->first();
        return view('whatshapp.index', compact('users', 'userChat'));
    }

    public function contact()
    {
        $users = User::all();
        return view('whatshapp.contact', compact('users'));
    }

    public function listContact()
    {
        $users = User::all();
        return view('whatshapp.listContact', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userChat = UserChat::where([
                            ['user_id', $request->userLogin],
                            ['sendto_userid', $request->selectedUser]
                        ])->orWhere([
                            ['user_id', $request->selectedUser],
                            ['sendto_userid', $request->userLogin],
                        ])->first();
        if ( $userChat == null ) {
            $chat = Chat::create([
                'last_message' => $request->comment,
            ]);

            $userChat = UserChat::create([
                'user_id' => $request->userLogin,
                'sendto_userid' => $request->selectedUser,
                'chat_id' => $chat->id,
            ]);
        }

        if ( $userChat !== null ) {
            Chat::where('id', $userChat->chat_id)->update([
                'last_message' => $request->comment,
            ]);
        }
        ChatMessage::create([
            'user_id' => $request->userLogin,
            'chat_id' => $userChat->chat_id,
            'type' => Str::contains($request->comment, $request->comment) ? 'text' : 'files',
            'message' => $request->comment,
        ]);

        $chatMessage = ChatMessage::where('chat_id', $userChat->chat_id)->orderBy('created_at', 'ASC')->get();
        MqttHelper::publish($request->topic, $request->comment);

        return view('whatshapp.chat', compact('chatMessage', 'userChat'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // dd($request->topic);
        $topic = $request->topic;
        $userChat = UserChat::where([
                            ['user_id', Auth::user()->id],
                            ['sendto_userid', $request->selectedUser],
                        ])->orWhere([
                            ['user_id', $request->selectedUser],
                            ['sendto_userid', Auth::user()->id],
                        ])->first();
        // dd(now());

        if ($userChat) {
            $chatMessage = ChatMessage::where('chat_id', $userChat->chat_id)->orderBy('created_at', 'ASC')->get();
            return view('whatshapp.chat', compact('chatMessage', 'topic', 'userChat'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
