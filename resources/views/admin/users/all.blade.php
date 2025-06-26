@extends('layouts.admin.master')

@section('content')
<title> لیست کاربران</title>
    <main role="main" class="col-md-9  col-lg-10 px-4 content">

                <!-- فرم لیست کاربران -->
                <div id="form-customer-list" >
                    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>لیست کاربران</span>
            <a href="{{ route('admin.users.create') }}" class="btn btn-success">
                افزودن کاربر جدید
            </a>
        </div>                <div class="card-body">
                            
                            <form class="form-inline mb-3" method="GET" action="{{ route('admin.users.all') }}">
                                <input type="text" name="query" class="form-control  mr-2" placeholder="جستجو براساس نام مشتری"
                                    value="{{ request('query') }}">
                                <button type="submit" class="btn btn-primary">جستجو</button> </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align: middle; text-align: center;">شناسه</th>
                                            <th style="vertical-align: middle; text-align: center;">نام   </th>
                                            <th style="vertical-align: middle; text-align: center;">ایمیل</th>
                                            <th style="vertical-align: middle; text-align: center;">شهر</th>
                                            <th style="vertical-align: middle; text-align: center;">شماره تماس</th>
                                            <th style="vertical-align: middle; text-align: center;">نقش کاربری</th>
                                            <th style="vertical-align: middle; text-align: center;">تاریخ عضویت</th>
                                            <th style="vertical-align: middle; text-align: center;">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td style="text-align: center; vertical-align: middle;">{{ $user->id }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $user->first_name }}{{ ' ' }}{{ $user->last_name }}
                                                </td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $user->email }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $user->city }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $user->phone }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $user->role == 'admin' ? 'ادمین' : 'کاربر' }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ \Morilog\Jalali\Jalalian::fromCarbon($user->created_at)->format('Y/m/d H:i')}}</td>
                                                <td style="text-align: center; vertical-align: middle;" >
                                                    <a href="{{ route('admin.users.edit', $user->id) }}">
                                                        <button class="btn action-btn  btn-info">ویرایش</button>
                                                    </a>
                                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="post" class="d-inline" onsubmit="return confirmDelete()">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn action-btn btn-danger">حذف</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </main>
            </div>
            </div>
@endsection