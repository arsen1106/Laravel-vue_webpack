<?php

namespace App\Rest\version\v1;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\ContactUsResource;

class NotificationController extends ApiController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function putContact(Request $request)
    {
        $contact = ContactUs::create($request->all());
        return response()->json(['data'=>$contact],Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getContacts (Request $request)
    {
        if($this->auth()->isSuperAdmin())
            return ContactUsResource::collection(ContactUs::orderBy('created_at','DESC')->paginate(25));
        return ContactUsResource::collection(ContactUs::where('user_id',auth()->id())->paginate(25));
    }
}
