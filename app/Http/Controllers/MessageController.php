<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(!auth()->check()) return JsonResponse::create('Not found', '304');
        return auth()->user()->messagesRecv()->orderBy('id', 'desc')->paginate(15);
    }
    
    public function page()
    {
        if(!auth()->check()) return redirect()->back()->with('warning', 'You are not logged in');
        return view('messages');
    }
	
    public function read(Request $request)
    {
        if(!auth()->check()) return Response::create('Unauthorized', '401');
        if($request->has('m_ids')) {
            $ids = $request->get('m_ids');
            Message::whereTo(auth()->user()->id)->whereIn('id', $ids)->update(['read' => date('Y-m-d H:i:s')]);
            return 1;
        }
    }

    public function readall()
    {
        if(!auth()->check()) return Response::create('Unauthorized', '401');
        Message::whereTo(auth()->user()->id)->unread()->update(['read' => date('Y-m-d H:i:s')]);
        return 1;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
