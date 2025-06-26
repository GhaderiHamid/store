@extends('layouts.frontend.master')

@section('content')
<title> ویرایش کامنت </title>
    <div class="container custom-container mt-5">
        <h2 class="text-white">ویرایش دیدگاه</h2>
        <form action="{{ route('user.comments.update', $comment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="comment_text" class="text-white">متن دیدگاه:</label>
                <textarea name="comment_text" id="comment_text" class="form-control" rows="5" required>{{ $comment->comment_text }}</textarea>
            </div>
            <button type="submit" class="btn btn-success mt-3">ذخیره تغییرات</button>
        </form>
    </div>
@endsection
