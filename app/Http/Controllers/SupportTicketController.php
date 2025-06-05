<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\SupportTicketReply;
use Illuminate\Support\Facades\Auth;

class SupportTicketController extends Controller
{
    public function index()
    {
        $tickets = SupportTicket::where('user_id', Auth::id())->latest()->get();
        return view('frontend.support.index', compact('tickets'));
    }

    public function create()
    {
        return view('frontend.support.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        $ticket = SupportTicket::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'open',
        ]);
        return redirect()->route('frontend.support.show', $ticket->id)->with('success', 'تیکت با موفقیت ثبت شد.');
    }

    public function show(SupportTicket $ticket)
    {
        $ticket->load('replies.user');
        return view('frontend.support.show', compact('ticket'));
    }

    public function reply(Request $request, SupportTicket $ticket)
    {
        // جلوگیری از ارسال پاسخ اگر تیکت بسته باشد
        if ($ticket->status === 'closed') {
            return back()->with('error', 'این تیکت بسته شده است و امکان ارسال پاسخ وجود ندارد.');
        }
        $request->validate([
            'message' => 'required|string',
        ]);
        SupportTicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);
        return back()->with('success', 'پاسخ شما ارسال شد.');
    }

    public function destroy(SupportTicket $ticket)
    {
        // فقط کاربر صاحب تیکت می‌تواند آن را حذف کند
        if ($ticket->user_id !== Auth::id()) {
            abort(403, 'شما اجازه حذف این تیکت را ندارید.');
        }
        $ticket->delete();
        return redirect()->route('frontend.support')->with('success', 'تیکت با موفقیت حذف شد.');
    }

    public function update(Request $request, SupportTicket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            abort(403, 'شما اجازه ویرایش این تیکت را ندارید.');
        }
        if ($ticket->status === 'closed') {
            return back()->with('error', 'تیکت بسته شده است و امکان ویرایش پیام وجود ندارد.');
        }
        $request->validate([
            'message' => 'required|string',
        ]);
        $ticket->message = $request->message;
        $ticket->save();
        return back()->with('success', 'پیام تیکت با موفقیت ویرایش شد.');
    }

    public function updateReply(Request $request, SupportTicket $ticket, SupportTicketReply $reply)
    {
        if ($reply->user_id !== Auth::id()) {
            abort(403, 'شما اجازه ویرایش این پیام را ندارید.');
        }
        if ($ticket->status === 'closed') {
            return back()->with('error', 'تیکت بسته شده است و امکان ویرایش پیام وجود ندارد.');
        }
        $request->validate([
            'message' => 'required|string',
        ]);
        $reply->message = $request->message;
        $reply->save();
        return redirect()->route('frontend.support.show', $ticket->id)->with('success', 'پاسخ با موفقیت ویرایش شد.');
    }
}
