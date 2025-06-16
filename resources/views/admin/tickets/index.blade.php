@extends('layouts.admin.master')
@section('content')
        <main role="main" class="col-md-9  col-lg-10 px-4 content">
        <div class="container mt-4">
            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-gradient" style="background: linear-gradient(90deg,#36d1c4 0,#5b86e5 100%); color:#fff;">
                    <span class="material-symbols-outlined align-middle">support_agent</span>
                    تیکت‌های کاربران
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-center align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th>کاربر</th>
                                    <th>موضوع</th>
                                    <th>وضعیت</th>
                                    <th>تاریخ</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->user->first_name }} {{ $ticket->user->last_name }}</td>
                                    <td>{{ $ticket->subject }}</td>
                                    <td>
                                        @if($ticket->status == 'open')
                                            <span class="badge badge-success">باز</span>
                                        @elseif($ticket->status == 'closed')
                                            <span class="badge badge-secondary">بسته</span>
                                        @else
                                            <span class="badge badge-warning">{{ $ticket->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ jdate($ticket->created_at)->format('Y/m/d H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="btn btn-sm btn-info rounded-pill d-flex align-items-center gap-1 px-3 py-2">
                                            <span class="material-symbols-outlined align-middle">visibility</span>
                                            مشاهده و پاسخ
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @if($tickets->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-muted py-4">
                                        <span class="material-symbols-outlined align-middle" style="font-size:2rem;">info</span>
                                        تیکتی وجود ندارد.
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    </div>

    </div>

   
@endsection
