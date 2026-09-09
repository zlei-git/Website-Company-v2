<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class AdminMessageController extends Controller
{
    public function index(Request $request)
    {
        $query = Message::query();
        
        if ($request->filled('status')) {
            if ($request->status === 'unread') {
                $query->whereNull('read_at');
            } elseif ($request->status === 'read') {
                $query->whereNotNull('read_at');
            }
        }
        
        $messages = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();
        
        return view('admin.messages.index', compact('messages'));
    }

    public function show(Message $message)
    {
        if (is_null($message->read_at)) {
            $message->update(['read_at' => now()]);
        }
        
        return view('admin.messages.show', compact('message'));
    }

    public function markAsRead(Message $message)
    {
        if (is_null($message->read_at)) {
            $message->update(['read_at' => now()]);
        }
        
        return redirect()->back()->with('success', 'Message marked as read.');
    }

    public function destroy(Message $message)
    {
        $message->delete();
        
        return redirect()->route('admin.messages.index')->with('success', 'Message deleted successfully.');
    }
}
