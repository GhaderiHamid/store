<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use App\Models\SupportTicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportTicketAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = SupportTicket::with('user')->latest();

        if ($request->has('status') && in_array($request->status, ['open', 'closed'])) {
            $query->where('status', $request->status);
        }

        $tickets = $query->paginate(10); // صفحه‌بندی ۱۰ تایی

        return view('admin.tickets.index', compact('tickets'));
    }

    public function show(SupportTicket $ticket)
    {
        $ticket->load('user', 'replies.user');
        return view('admin.tickets.show', compact('ticket'));
    }

    public function reply(Request $request, \App\Models\SupportTicket $ticket)
    {
        if ($ticket->status === 'closed') {
            return back()->with('error', 'این تیکت بسته شده است و امکان ارسال پاسخ وجود ندارد.');
        }
        $request->validate([
            'message' => 'required|string',
        ]);
        \App\Models\SupportTicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::guard('admin')->id(),
            'message' => $request->message,
        ]);
        return back()->with('success', 'پاسخ شما ارسال شد.');
    }

    public function close(\App\Models\SupportTicket $ticket)
    {
        $ticket->status = 'closed';
        $ticket->save();
        return redirect()->route('admin.tickets.show', $ticket->id)->with('success', 'تیکت با موفقیت بسته شد.');
    }

    public function updateReply(Request $request, SupportTicket $ticket, SupportTicketReply $reply)
    {
        if ($reply->user_id !== Auth::guard('admin')->id()) {
            abort(403);
        }
        if ($ticket->status === 'closed') {
            return redirect()->route('admin.tickets.show', $ticket->id)->with('error', 'امکان ویرایش پاسخ پس از بسته شدن تیکت وجود ندارد.');
        }
        $request->validate([
            'message' => 'required|string',
        ]);
        $reply->message = $request->message;
        $reply->save();
        return redirect()->route('admin.tickets.show', $ticket->id)->with('success', 'پاسخ با موفقیت ویرایش شد.');
    }
}
