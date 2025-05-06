@extends('layouts.frontend.master')

@section('content')
    <div class="container custom-container mt-5">
        <h2 class="text-white">دیدگاه‌های شما</h2>

        @if (!$comments->isEmpty())
            @foreach ($comments as $comment)
                <div class="w-100 product-border p-3 mt-3 text-white border-white">
                    <img class="card-img-top  rounded" style="width: 100px;height: 100px "
                        src="/{{ $comment->product->image_path }}" alt="Product Image">
                    <div class="card-body col-sm-12">
                        <h5>محصول: {{ $comment->product->name }}</h5>
                        <p class="card-text mt-2">تاریخ ثبت دیدگاه: {{ \Morilog\Jalali\Jalalian::fromDateTime($comment->created_at)->format('H:i Y/m/d ') }}</p>

                        <p class="card-text mt-2">متن دیدگاه: {{ $comment->comment_text }}</p>

                    </div>

                    <div class="d-flex align-items-center justify-content-end mt-3">
                        <a href="{{ url('/products/' . $comment->product_id . '/single') }}" class="btn btn-primary mx-2">
                            مشاهده محصول
                        </a>
                        <a href="{{ route('user.comments.edit', $comment->id) }}" class="btn btn-warning mx-2">
                            ویرایش دیدگاه
                        </a>
                        <form action="{{ route('user.comments.destroy', $comment->id) }}" method="POST" class="ms-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">حذف دیدگاه</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-white">شما هیچ دیدگاهی ثبت نکرده‌اید.</p>
        @endif
    </div>
@endsection