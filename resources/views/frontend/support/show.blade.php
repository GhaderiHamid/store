@extends('layouts.frontend.master')
@section('content')
<title>   تیکت {{ $ticket->subject }}</title>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0 rounded-4 mb-4">
                <div class="card-header bg-primary text-white rounded-top-4 d-flex align-items-center gap-2" style="background: linear-gradient(90deg,#007bff 0,#6610f2 100%);">
                    <span class="material-symbols-outlined align-middle" style="font-size:1.5rem;">confirmation_number</span>
                    <span class="ml-2">موضوع: {{ $ticket->subject }}</span>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <span class="material-symbols-outlined text-secondary mr-2" style="font-size:1.3rem;">person</span>
                        <strong>{{ $ticket->user->first_name}} {{ $ticket->user->last_name }}</strong>
                        <span class="badge badge-info ml-2" style="font-size:0.9rem;">ایجاد کننده تیکت</span>
                    </div>
                    <div class="bg-light rounded p-3 mb-2 border-right border-primary" style="border-right: 4px solid #007bff;">
                        <p class="mb-1 text-dark" style="font-size:1.1rem;">{{ $ticket->message }}</p>
                        <small class="text-muted">
                            <span class="material-symbols-outlined align-middle" style="font-size:1rem;">calendar_month</span>
                            {{ jdate($ticket->created_at)->format('Y/m/d H:i') }}
                        </small>
                    </div>
                    @if(auth('web')->id() === $ticket->user_id && $ticket->status == 'open')
                    <form action="{{ route('frontend.support.update', $ticket->id) }}" method="POST" class="mb-3">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-2">
                            <label class="font-weight-bold mb-1">
                                <span class="material-symbols-outlined align-middle text-primary" style="font-size:1.1rem;">edit</span>
                                ویرایش پیام تیکت
                            </label>
                            <textarea name="message" class="form-control rounded-3 px-3 py-2" rows="3" required>{{ $ticket->message }}</textarea>
                        </div>
                        <button class="btn btn-warning btn-sm rounded-pill px-3 py-1 d-flex align-items-center gap-1" type="submit">
                            <span class="material-symbols-outlined align-middle">save</span>
                            ذخیره ویرایش
                        </button>
                    </form>
                    @endif
                </div>
            </div>
            @foreach($ticket->replies as $reply)
            <div class="card mb-3 mr-4 shadow-sm border-0 rounded-4 @if ($reply->user_id==auth('admin')->id())
                    ml-5
                @endif" style="background:rgba(245,247,255,0.7);">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                      
                        @if ($reply->user_id==auth('admin')->id())
                        <span class="material-symbols-outlined text-success mr-2" style="font-size:1.1rem;">reply</span>
                        <span class="badge badge-light mr-2" style="font-size:0.85rem;">admin</span>
                        {{-- <strong class="text-dark">admin</strong> --}}
                        @else
                        <span class="material-symbols-outlined" style="font-size:1.1rem; color:red; margin-left:0.5rem; transform: scaleX(-1); display:inline-block;">reply</span>           
                        <span class="badge badge-light mr-2" style="font-size:0.85rem;">شما</span>
                        {{-- <strong class="text-dark">شما</strong> --}}
                        @endif
                        
                       
                    </div>
                    @if ($reply->user_id==auth('admin')->id())
                        <div class="bg-white rounded p-2 mb-1 border-right border-success" style="border-right: 5px solid #28a745 !important;">

                    @else
                        <div class="bg-white rounded p-2 mb-1 border-right border-danger " style="border-right: 5px solid #ff0303 !important;">

                     @endif
                        @if($reply->user_id == auth('web')->id() && $ticket->status == 'open')
                            @if(request('edit_reply') == $reply->id)
                                <form action="{{ route('frontend.support.reply.update', [$ticket->id, $reply->id]) }}" method="POST" class="mb-2">
                                    @csrf
                                    @method('PUT')
                                    <textarea name="message" class="form-control rounded-3 px-3 py-2 mb-2" rows="3" required>{{ old('message', $reply->message) }}</textarea>
                                    <button type="submit" class="btn btn-success btn-sm rounded-pill px-3">ذخیره</button>
                                    <a href="{{ route('frontend.support.show', $ticket->id) }}" class="btn btn-secondary btn-sm rounded-pill px-3">انصراف</a>
                                </form>
                            @else
                                <p class="mb-1 text-dark" style="font-size:1.05rem;">{{ $reply->message }}</p>
                                <a href="{{ route('frontend.support.show', [$ticket->id, 'edit_reply' => $reply->id]) }}" class="btn btn-link btn-sm px-2 py-0">ویرایش</a>
                            @endif
                        @else
                            <p class="mb-1 text-dark" style="font-size:1.05rem;">{{ $reply->message }}</p>
                        @endif
                        <small class="text-muted">
                            <span class="material-symbols-outlined align-middle" style="font-size:1rem;">calendar_month</span>
                            {{ jdate($reply->created_at)->format('Y/m/d H:i') }}
                        </small>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="card shadow border-0 rounded-4 mt-4">
                <div class="card-body">
                    @if($ticket->status == 'open')
                    <form action="{{ route('frontend.support.reply', $ticket->id) }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="font-weight-bold mb-2">
                                <span class="material-symbols-outlined align-middle text-primary" style="font-size:1.2rem;">edit_note</span>
                                پاسخ شما
                            </label>
                            <textarea name="message" class="form-control rounded-3 px-3 py-2" rows="4" required placeholder="متن پاسخ خود را بنویسید"></textarea>
                        </div>
                        <button class="btn btn-primary rounded-pill px-4 py-2 d-flex align-items-center gap-1" type="submit" style="background: linear-gradient(90deg,#36d1c4 0,#5b86e5 100%); border: none;">
                            <span class="material-symbols-outlined align-middle">send</span>
                            ارسال پاسخ
                        </button>
                    </form>
                    @else
                    <div class="alert alert-warning rounded-3 mb-0" style="font-size:1.05rem;">
                        این تیکت بسته شده است و امکان ارسال پاسخ وجود ندارد.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
