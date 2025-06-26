@extends('layouts.frontend.master')
@section('content')
<title> تیکت های من </title>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">
                <span class="material-symbols-outlined align-middle text-primary" style="font-size:2rem;">support_agent</span>
                تیکت‌های من
            </h4>
            <a href="{{ route('frontend.support.create') }}" class="btn btn-success shadow rounded-pill px-4 py-2 d-flex align-items-center gap-2" style="font-size:1.1rem;">
                <span class="material-symbols-outlined align-middle">add_circle</span>
                <span>ثبت تیکت جدید</span>
            </a>
        </div>
        <div class="card shadow-lg border-0 rounded-4" style="background:rgba(255,255,255,0.97);">
            <div class="card-body p-0">
                <table class="table table-hover mb-0 text-center align-middle" style="border-radius: 1rem; overflow: hidden;">
                    <thead class="bg-gradient" style="background: linear-gradient(90deg,#007bff 0,#6610f2 100%);">
                        <tr>
                            <th class="text-white" style="font-size:1.1rem;">موضوع</th>
                            <th class="text-white" style="font-size:1.1rem;">وضعیت</th>
                            <th class="text-white" style="font-size:1.1rem;">تاریخ</th>
                            <th class="text-white" style="font-size:1.1rem;">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tickets as $ticket)
                        <tr class="bg-light" style="transition: background 0.2s; border-bottom:2px solid #f1f1f1;">
                            <td class="font-weight-bold text-primary" style="font-size:1.05rem;">
                                <span class="material-symbols-outlined align-middle text-secondary" style="font-size:1.2rem;">label</span>
                                {{ $ticket->subject }}
                            </td>
                            <td>
                                @if($ticket->status == 'open')
                                    <span class="badge badge-success px-3 py-2 rounded-pill d-flex align-items-center gap-1" style="font-size:1rem;">
                                        <span class="material-symbols-outlined align-middle" style="font-size:1rem;">mark_email_unread</span>
                                        باز
                                    </span>
                                @elseif($ticket->status == 'closed')
                                    <span class="badge badge-secondary px-3 py-2 rounded-pill d-flex align-items-center gap-1" style="font-size:1rem;">
                                        <span class="material-symbols-outlined align-middle" style="font-size:1rem;">lock</span>
                                        بسته
                                    </span>
                                @else
                                    <span class="badge badge-warning px-3 py-2 rounded-pill" style="font-size:1rem;">{{ $ticket->status }}</span>
                                @endif
                            </td>
                            <td style="font-size:1rem;">
                                <span class="material-symbols-outlined align-middle text-info" style="font-size:1rem;">calendar_month</span>
                                {{ jdate($ticket->created_at)->format('Y/m/d H:i') }}
                            </td>
                            <td>
                                <div class="d-flex flex-row align-items-center gap-2 justify-content-center">
                                    <a href="{{ route('frontend.support.show', $ticket->id) }}" class="btn btn-sm btn-info shadow rounded-pill d-flex align-items-center gap-1 px-3 py-2" style="font-size:1rem; background: linear-gradient(90deg,#36d1c4 0,#5b86e5 100%); border: none;">
                                        <span class="material-symbols-outlined align-middle">visibility</span>
                                        مشاهده
                                    </a>
                                    <form action="{{ route('frontend.support.destroy', $ticket->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('آیا از حذف این تیکت مطمئن هستید؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger shadow rounded-pill d-flex align-items-center gap-1 px-3 py-2 mx-1" style="font-size:1rem;">
                                            <span class="material-symbols-outlined align-middle">delete</span>
                                            حذف
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-muted py-4" style="font-size:1.1rem; background: #f8fafc;">
                                <div class="d-flex flex-column align-items-center">
                                    <span class="material-symbols-outlined align-middle mb-2" style="font-size:2.5rem; color:#bdbdbd;">sentiment_dissatisfied</span>
                                    <span>تیکتی ثبت نشده است.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
