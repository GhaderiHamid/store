@extends('layouts.admin.master')

@section('content')
<title> ویرایش کاربر</title>
    <main role="main" class="col-md-9  col-lg-10 px-4 content">

            <!-- فرم بروزرساني کاربر جدید -->
            <div id="form-add-customer">
                <div class="card">
                    <div class="card-header">بروزرساني کاربر </div>
                    @include('errors.message')
                    <div class="card-body">
                        <form action="{{ route('admin.users.update', $user->id) }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="form-group">
                                <label for="customerName">نام </label>
                                <input type="text" class="form-control" name="first_name" id="customerName"
                                    placeholder="نام را وارد کنید" value="{{ $user->first_name }}">
                            </div>
                            <div class="form-group">
                                <label for="customerName">نام خانوادگی </label>
                                <input type="text" class="form-control" name="last_name" id="customerName"
                                    placeholder="نام خانوادگی را وارد کنید" value="{{ $user->last_name }}">
                            </div>
                            <div class="form-group">
                                <label for="customerEmail">ایمیل</label>
                                <input type="email" class="form-control" name="email" id="customerEmail"
                                    placeholder="ایمیل خود را وارد کنید" value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                                <label for="customerAddress">شهر</label>
                                <input type="text" class="form-control" name="city" id="customercity"
                                    placeholder=" شهر خود را وارد کنید" value="{{ $user->city }}">

                            </div>
                            <div class="form-group">
                                <label for="customerPhone">شماره تماس</label>
                                <input type="text" class="form-control" name="phone" id="customerPhone"
                                    placeholder=" شماره تماس خود را وارد کنید" value="{{ $user->phone }}">
                            </div>
                            <div class="form-group">
                                <label for="customerAddress">آدرس خود را وارد کنید</label>
                                <textarea class="form-control" name="address" id="customerAddress" rows="2"
                                    placeholder="آدرس کاربر" >{{ $user->address }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>نقش کاربری</label>
                                <select class="form-control" name="role">
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}> مشتری</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>مدیر</option>

                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">بروزرساني کاربر</button>
                            <button type="reset" class="btn btn-secondary">بازنشانی</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        </div>
        </div>
@endsection