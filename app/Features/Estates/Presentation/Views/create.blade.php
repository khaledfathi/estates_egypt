@extends('shared::main-layout')
@section('title', 'العقارات | اضافة عقار')
@section('active-estates', 'active')

@section('content')
    <div class="container-fluid ">
        {{-- Errors --}}
        @if ($errors->any())
            <div class="row" style="display:flex; justify-content:center;">
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <div class="card card-inverse card-danger">
                        <div class="card-block">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{-- / Errors --}}

        <div class="row" style="display:flex; justify-content: center;">
            <form id="form" class="col-sm-12 col-md-10 col-lg-6" method="post" action="{{ route('estates.store') }}">
                <div class="card">
                    <div class="card-header">
                        <strong>اضافة عقار</strong>
                    </div>
                    <div class="card-block">
                        @csrf

                        {{-- name --}}
                        <div class="form-group">
                            <label for="name">الاسم <span class="required">*</span></label>
                            <input name="name" type="text" class="form-control" id="name"
                                placeholder="اسم رمزى للعقار" value="{{ old('name') }}">
                        </div>
                        {{-- / name --}}

                        {{-- address --}}
                        <div class="form-group">
                            <label for="address">العنوان <span class="required">*</span></label>
                            <textarea name="address" class="form-control" id="address" placeholder="وصف دقيق للعنوان">{{ old('address') }}</textarea>
                        </div>
                        {{-- / address --}}

                        {{-- floor counts --}}
                        <div class="form-group">
                            <label for="floor_count">عدد الطوابق <span class="required">*</span></label>
                            <input name="floor_count" type="text" class="form-control" id="floor_count"
                                placeholder="عدد الطوابق مع الطابق الارضى" value={{ old('floor_count') }}>
                        </div>
                        {{-- / floor counts --}}


                        {{-- residential unit count --}}
                        <div class="form-group">
                            <label for="residential_unit_count">عدد الوحدات السكنية</label>
                            <input name="residential_unit_count" type="text" class="form-control" id="residential_unit_count"
                                placeholder="عدد الوحدات السكنية" value={{ old('residential_unit_count') }}>
                        </div>
                        {{-- / residential unit count --}}

                        {{-- commercial unit count--}}
                        <div class="form-group">
                            <label for="commercial_unit_count">عدد الوحدات التجارية</label>
                            <input name="commercial_unit_count" type="text" class="form-control" id="commercial_unit_count"
                                placeholder="عدد الوحدات التجارية" value={{ old('commercial_unit_count') }}>
                        </div>
                        {{-- / commercial unit count--}}

                        {{-- buttons --}}
                        <div class="form-group" style="margin-top: 40px">
                            <button id="submit-btn" type="submit" class="btn btn-md btn-success"><i
                                    class="fa fa-dot-circle-o"></i>
                                اضافة</button>
                            <a href="{{ route('estates.index') }}" class="btn btn-md btn-danger"><i class="fa fa-ban"></i>
                                الغاء</a>
                        </div>
                        {{-- / buttons --}}
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
