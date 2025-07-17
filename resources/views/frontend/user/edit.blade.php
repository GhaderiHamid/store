@extends('layouts.frontend.master')

@section('content')
<title>ویرایش حساب کاربری </title>
    <div class="container my-5 d-flex justify-content-center">
        <div class="card shadow-lg border-0" style="max-width: 500px; width: 100%; background: linear-gradient(135deg, #23272b 80%, #198754 100%);">
            <div class="card-body p-4">
             <div class="d-flex align-items-center ">
                <span class="material-icons " style="font-size: 2.5rem;  color: #198754;">person</span>
                <h5 class="card-title  text-center text-white  p-0 m-0" style="letter-spacing: 1px;">
<mak>
                    ویرایش حساب کاربری
</mak></h5>
             </div>

                @if(session('success'))
                    <div class="alert alert-success text-center">{{ session('success') }}</div>
                @endif
                <form method="POST" action="{{ route('user.profile.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="first_name" class="form-label text-white"><mak>نام </mak></label>
                        <div class="input-group">
                            <span class="input-group-text bg-info text-white border-0">
                                <span class="material-icons">badge</span>
                            </span>
                            <input type="text" class="form-control bg-dark text-white @error('name') is-invalid @enderror"
                                id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}">
                        </div>
                        @error('first_name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label text-white"><mak>نام خانوادگی </mak></label>
                        <div class="input-group">
                            <span class="input-group-text bg-info text-white border-0">
                                <span class="material-icons">badge</span>
                            </span>
                            <input type="text" class="form-control bg-dark text-white @error('last_name') is-invalid @enderror"
                                id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}">
                        </div>
                        @error('last_name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label text-white"><mak>ایمیل </mak></label>
                        <div class="input-group">
                            <span class="input-group-text bg-info text-white border-0">
                                <span class="material-icons">email</span>
                            </span>
                            <input type="email" class="form-control bg-dark text-white @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email', $user->email) }}">
                        </div>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label text-white"><mak>رمز عبور جدید </mak></label>
                        <div class="input-group">
                            <span class="input-group-text bg-info text-white border-0">
                                <span class="material-icons">lock</span>
                            </span>
                            <input type="password" class="form-control bg-dark text-white @error('password') is-invalid @enderror"
                                id="password" name="password" autocomplete="new-password" placeholder="در صورت نیاز به تغییر رمز عبور">
                        </div>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label text-white"><mak>شهر </mak></label>
                        <div class="input-group">
                            <span class="input-group-text bg-info text-white border-0">
                                <span class="material-icons">location_city</span>
                            </span>
                            <input type="text" class="form-control bg-dark text-white @error('city') is-invalid @enderror"
                                id="city" name="city" value="{{ old('city', $user->city) }}">
                        </div>
                        @error('city')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label text-white"><mak>شماره تلفن </mak></label>
                        <div class="input-group">
                            <span class="input-group-text bg-info text-white border-0">
                                <span class="material-icons">phone</span>
                            </span>
                            <input type="text" class="form-control bg-dark text-white @error('phone') is-invalid @enderror"
                                id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                        </div>
                        @error('phone')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="sheba_number" class="form-label text-white"><mak>شماره شبا </mak></label>
                        <div class="input-group">
                            <span class="input-group-text bg-info text-white border-0">
                                <span class="material-icons">account_balance</span> <!-- آیکون جدید -->
                            </span>
                            <input type="text" maxlength="26" class="form-control bg-dark text-white @error('sheba_number') is-invalid @enderror"
                                id="sheba_number" name="sheba_number" value="{{ old('sheba_number', $user->sheba_number) }}">
                        </div>
                        @error('sheba_number')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label text-white"><mak>آدرس </mak></label>
                        <div class="input-group">
                            <span class="input-group-text bg-info text-white border-0">
                                <span class="material-icons">home</span>
                            </span>
                            <textarea class="form-control bg-dark text-white @error('address') is-invalid @enderror"
                                id="address" name="address" rows="2">{{ old('address', $user->address) }}</textarea>
                        </div>
                        @error('address')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-success btn-block py-2 fw-bold" style="font-size: 1.1rem;">
                            <span class="material-icons align-middle" style="vertical-align: middle;">save</span>
                            ذخیره تغییرات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
