@extends('shared::main-layout')
@section('title', 'مستندات العقار | اضافة مستند')
@section('active-estates', 'active')
@section('breadcrumbs')
    @isset($estate)
        {{ Diglactic\Breadcrumbs\Breadcrumbs::render('estates.documents.create', $estate->id) }}
    @endisset
@endsection
@section('content')
    <div class="container-fluid ">

        {{-- Errors --}}
        @if ($errors->any() || session()->has('error'))
            <div class="row" style="display:flex; justify-content:center;">
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <div class="card card-inverse card-danger ">
                        <div class="card-block">
                            <ul>
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                @elseif (session('error'))
                                    <li>{{ session('error') }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
        {{-- / Errors --}}

        {{-- success message  --}}
        @if (session('success'))
            <div class="row" style="display:flex; justify-content:center;">
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <div class="card card-inverse card-success">
                        <div class="card-block">
                            <ul>
                                <li>{{ session('success') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{-- / success message  --}}

        {{-- estaet information  --}}
        @isset($estate)
            <div class="card">
                <div class="card-header">
                    بيانات العقار
                </div>
                <div class="card-block">
                    <ul>
                        <li>اسم العقار : {{ $estate->name }}</li>
                        <li>عدد الطوابق : {{ $estate->floorCount }}</li>
                        <li>عدد الوحدات : {{ $estate->unitCount }} ( سكنى {{ $estate->residentialUnitCount }} ) - ( تجارى
                            {{ $estate->commercialUnitCount }})</li>
                    </ul>
                </div>
            </div>
        @endisset
        {{-- / estaet information  --}}

        <div class="row" style="display:flex; justify-content: center;">
            <form id="form" class="col-sm-12 col-md-10 col-lg-6" method="post"
                action="{{ route('estates.documents.store', $estate->id) }}" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <strong>اضافة مستند</strong>
                    </div>
                    <div class="card-block">
                        @csrf
                        {{-- title --}}
                        <div class="form-group">
                            <label for="title">عنوان المستند<span class="required">*</span></label>
                            <input name="title" type="text" class="form-control" id="title"
                                placeholder="اسم بسيط للمستند" value="{{old('title')}}">
                        </div>
                        {{-- / title --}}

                        {{-- description --}}
                        <div class="form-group">
                            <label for="description">وصف المستند</label>
                            <textarea name="description" type="text" class="form-control" id="description" placeholder="وصف دقيق للمستند">{{old('description')}}</textarea>
                        </div>
                        {{-- / description --}}

                        {{-- file --}}
                        <div class="form-group">
                            <label for="description">الملف <span class="required">*</span></label>
                            <input class="form-control" name="file" type="file" id="file" name="file-input">
                        </div>
                        {{-- / file --}}

                        {{-- buttons --}}
                        <div class="form-group" style="margin-top: 40px">
                            <button id="submit-btn" type="submit" class="btn btn-md btn-success">
                                <i class="fa fa-plus-circle "></i>
                                اضافة</button>
                            <a href="{{ route('estates.documents.index', $estate->id) }}" class="btn btn-md btn-danger"><i
                                    class="fa fa-ban"></i>
                                الغاء</a>
                        </div>
                        {{-- / buttons --}}
                    </div>
                </div>
            </form>
        </div>

</div>
@endsection
