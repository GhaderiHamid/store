@extends('layouts.admin.master')
@section('content')
    <main role="main" class="col-md-9  col-lg-10 px-4 content">
            <div class="container mt-4" style="background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%); border-radius: 2.5rem; padding: 2.5rem 0; box-shadow: 0 8px 32px rgba(44,62,80,0.08);">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 p-0" >
                        <div class="card shadow-lg border-0 rounded-5 mb-4" style="overflow:hidden; transition: box-shadow 0.2s; border: 1.5px solid #e3e8f7;">
                            <div class="card-header bg-primary text-white rounded-top-5 d-flex align-items-center gap-2" style="background: linear-gradient(90deg,#007bff 0,#6610f2 100%); border-bottom: 2px solid #36d1c4; box-shadow: 0 2px 12px rgba(102,16,242,0.07);">
                                <span class="material-symbols-outlined align-middle" style="font-size:1.8rem;">confirmation_number</span>
                                <span class="ml-2" style="font-size:1.18rem; letter-spacing:0.5px;">موضوع: {{ $ticket->subject }}</span>
                            </div>
                            <div class="card-body" style="background:rgba(255,255,255,0.98); border-radius:0 0 2rem 2rem;">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="material-symbols-outlined text-secondary mr-2" style="font-size:1.35rem;">person</span>
                                    <strong style="font-size:1.12rem; color:#222;">{{ $ticket->user->first_name}} {{ $ticket->user->last_name }}</strong>
                                    <span class="badge badge-info mr-2" style="font-size:1rem; background:linear-gradient(90deg,#36d1c4 0,#5b86e5 100%); color:#fff; box-shadow:0 2px 8px rgba(54,209,196,0.13); border-radius:1rem;">ایجاد کننده تیکت</span>
                                </div>
                                <div class="bg-light rounded-4 p-3 mb-2 border-right border-primary" style="border-right: 4px solid #007bff; box-shadow:0 2px 8px rgba(0,123,255,0.09);">
                                    <p class="mb-1 text-dark" style="font-size:1.16rem; line-height:1.9; letter-spacing:0.01em;">{{ $ticket->message }}</p>
                                    <small class="text-muted">
                                        <span class="material-symbols-outlined align-middle" style="font-size:1rem;">calendar_month</span>
                                        {{ jdate($ticket->created_at)->format('Y/m/d H:i') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        @foreach($ticket->replies as $reply)
                        <div class="card mb-3  shadow-sm border-0 rounded-4 @if ($reply->user_id==auth('web')->id())
                            mr-5
                            @else
                            ml-5
                        @endif" style="background:rgba(245,247,255,0.7);">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                               
                                @if ($reply->user_id==auth('web')->id())
                                <span class="material-symbols-outlined text-success ml-2" style="font-size:1.1rem;">reply</span>
                                <span class="badge badge-light ml-2" style="font-size:0.85rem;">کاربر</span>
                                {{-- <strong class="text-dark">کاربر</strong> --}}
                                @else
                                <span class="material-symbols-outlined" style="font-size:1.1rem; color:red; margin-left:0.5rem; transform: scaleX(-1); display:inline-block;">reply</span>                  
                                <span class="badge badge-light ml-2" style="font-size:0.85rem;">شما</span>
                                {{-- <strong class="text-dark">شما</strong> --}}
                                @endif
                                
                                
                            </div>
                            @if ($reply->user_id==auth('web')->id())
                                <div class="bg-white rounded p-2 mb-1 border-right border-success" style="border-right: 5px solid #28a745 !important;">
        
                            @else
                                <div class="bg-white rounded p-2 mb-1 border-right border-danger " style="border-right: 5px solid #ff0303 !important;">
        
                             @endif                                   {{-- اگر پاسخ توسط ادمین فعلی ثبت شده باشد و تیکت باز باشد، دکمه ویرایش نمایش داده شود --}}
                                        @if($reply->user_id == auth('admin')->id())
                                            @if($ticket->status == 'open')
                                                @if(request('edit_reply') == $reply->id)
                                                    <form action="{{ route('admin.tickets.reply.update', [$ticket->id, $reply->id]) }}" method="POST" class="mb-2">
                                                        @csrf
                                                        @method('PUT')
                                                        <textarea name="message" class="form-control rounded-4 px-3 py-2 mb-2" rows="3" required>{{ old('message', $reply->message) }}</textarea>
                                                        <button type="submit" class="btn btn-success btn-sm rounded-pill px-3">ذخیره</button>
                                                        <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="btn btn-secondary btn-sm rounded-pill px-3">انصراف</a>
                                                    </form>
                                                @else
                                                    <p class="mb-1 text-dark" style="font-size:1.11rem; line-height:1.85;">{{ $reply->message }}</p>
                                                    <a href="{{ route('admin.tickets.show', [$ticket->id, 'edit_reply' => $reply->id]) }}" class="btn btn-link btn-sm px-2 py-0">ویرایش</a>
                                                @endif
                                            @else
                                                <p class="mb-1 text-dark" style="font-size:1.11rem; line-height:1.85;">{{ $reply->message }}</p>
                                            @endif
                                        @else
                                            <p class="mb-1 text-dark" style="font-size:1.11rem; line-height:1.85;">{{ $reply->message }}</p>
                                        @endif
                                        <small class="text-muted">
                                            <span class="material-symbols-outlined align-middle" style="font-size:1rem;">calendar_month</span>
                                            {{ jdate($reply->created_at)->format('Y/m/d H:i') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="card shadow border-0 rounded-4 mt-4" style="box-shadow: 0 6px 28px rgba(54,209,196,0.15); border-top:2px solid #36d1c4;">
                            <div class="card-body" style="background:rgba(255,255,255,0.99); border-radius:1.5rem;">
                                @if($ticket->status == 'open')
                                <form action="{{ route('admin.tickets.reply', $ticket->id) }}" method="post">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold mb-2">
                                            <span class="material-symbols-outlined align-middle text-primary" style="font-size:1.22rem;">edit_note</span>
                                            پاسخ شما
                                        </label>
                                        <textarea name="message" class="form-control rounded-4 px-3 py-2" rows="4" required placeholder="متن پاسخ خود را بنویسید" style="background:rgba(245,247,255,0.85); border:1.5px solid #36d1c4; box-shadow: 0 2px 8px rgba(54,209,196,0.11); font-size:1.07rem;"></textarea>
                                    </div>
                                    <button class="btn btn-primary rounded-pill px-4 py-2 d-flex align-items-center gap-1 shadow" type="submit" style="background: linear-gradient(90deg,#36d1c4 0,#5b86e5 100%); border: none; box-shadow: 0 2px 14px rgba(91,134,229,0.18); transition: background 0.2s, box-shadow 0.2s;">
                                        <span class="material-symbols-outlined align-middle">send</span>
                                        ارسال پاسخ
                                    </button>
                                </form>
                                <form action="{{ route('admin.tickets.close', $ticket->id) }}" method="POST" class="mt-3">
                                    @csrf
                                    <button type="submit" class="btn btn-warning rounded-pill px-4 py-2 d-flex align-items-center gap-1 shadow" style="font-size:1rem;">
                                        <span class="material-symbols-outlined align-middle">lock</span>
                                        بستن تیکت
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
        </main>

        </div>

        </div>

       
@endsection
