@extends('layouts.admin.master')

@section('content')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 content">

            <!-- فرم لیست کاربران -->
            <div id="form-customer-list" >
                <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>لیست کاربران</span>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success">
            افزودن کاربر جدید
        </a>
    </div>                <div class="card-body">
                        <form class="form-inline mb-3">
                            <input type="text" class="form-control mr-2" placeholder="جستجو بر اساس نام مشتری">
                            <button type="submit" class="btn btn-primary">جستجو</button>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>شناسه</th>
                                        <th>نام ونام خانوادگی</th>
                                        <th>ایمیل</th>
                                        <th>شماره تماس</th>
                                        <th>نقش کاربری</th>
                                        <th>تاریخ عضویت</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td> {{ $user->first_name }}{{ $user->last_name }}</td>
                                        <td>{{ $user->email  }}</td>
                                        <td>{{ $user->phone	 }}</td>
                                        <td>{{ $user->role == 'admin' ? 'ادمین' : 'کاربر' }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                        <a href="{{ route('admin.users.edit', $user->id) }}"><button class="btn ml-2 btn-info">ویرایش</button>
                                        </a>
                                        <form action="{{ route('admin.users.delete', $user->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn  btn-danger">حذف</button>
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