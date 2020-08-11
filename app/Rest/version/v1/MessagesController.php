<?php

namespace App\Rest\version\v1;

use App\Http\Resources\ChatResource;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessagesController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ChatResource::collection($this->auth()->messages()->pagginate(50));
    }

    /**
     * Get All Messages With User
     * @param User $specificUser
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function messages( Request $request, User $user)
    {
        $this->auth()->putUser($user);
        return ChatResource::collection($this->auth()->messages()->paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ChatResource
     */
    public function store(Request $request)
    {
        $message = Chat::create([
            'text' => $request->text,
            'from_user_id' => $this->auth()->id,
            'to_user_id' => $request->userId,
            'resource' => '',
        ]);
        return new ChatResource($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
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
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {

    }
}
