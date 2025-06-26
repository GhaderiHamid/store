@extends('layouts.admin.master')

@section('content')
<title> لیست ماموران</title>
    <main role="main" class="col-md-9  col-lg-10 px-4 content">

                <!-- فرم لیست ماموران -->
                <div id="form-customer-list" >
                    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>لیست ماموران</span>
            <a href="{{ route('admin.shippers.create') }}" class="btn btn-success">
                افزودن مامور جدید
            </a>
        </div>                <div class="card-body">
                            
                            <form class="form-inline mb-3" method="GET" action="{{ route('admin.shippers.all') }}">
                                <input type="text" name="query" class="form-control  mr-2" placeholder="جستجو براساس نام "
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
                                          
                                            <th style="vertical-align: middle; text-align: center;">تاریخ عضویت</th>
                                            <th style="vertical-align: middle; text-align: center;">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($shippers as $shipper)
                                            <tr>
                                                <td style="text-align: center; vertical-align: middle;">{{ $shipper->id }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $shipper->first_name }}{{ ' ' }}{{ $shipper->last_name }}
                                                </td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $shipper->email }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $shipper->city }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $shipper->phone }}</td>
             
                                                <td style="text-align: center; vertical-align: middle;">{{ \Morilog\Jalali\Jalalian::fromCarbon($shipper->created_at)->format('Y/m/d H:i')}}</td>
                                                <td style="text-align: center; vertical-align: middle;" >
                                                    <a href="{{ route('admin.shippers.edit', $shipper->id) }}">
                                                        <button class="btn action-btn  btn-info">ویرایش</button>
                                                    </a>
                                                    <form action="{{ route('admin.shippers.delete', $shipper->id) }}" method="post"
                                                        class="d-inline" onsubmit="return confirmDelete()">
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
                            {{ $shippers->links() }}
                        </div>
                    </div>
                </div>
            </main>
            </div>
            </div>
@endsection