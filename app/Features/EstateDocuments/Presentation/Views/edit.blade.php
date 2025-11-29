@extends('shared::main-layout')
@section('title', 'مستندات العقار | تحديث المستند')
@section('active-estates', 'active')
@section('breadcrumbs')
    @isset($estateDocument)
        {{ Diglactic\Breadcrumbs\Breadcrumbs::render('estates.documents.edit', $estate->id , $estateDocument->id ) }}
    @endisset
@endsection
@section('styles')
    @vite('resources/css/features/estate-documents/edit.css')
@endsection
@section('content')
    <div class="container-fluid ">
        {{-- Errors --}}
        @if ($errors->any() || session()->has('error') || isset($error))
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
                                @elseif (isset($error))
                                        <li>{{ $error }}</li>
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
                        <li> العنوان :
                            <pre>{{ $estate->address }}</pre>
                        </li>
                    </ul>
                </div>
            </div>
        @endisset
        {{-- / estaet information  --}}

        @isset($estate)
            <div class="row" style="display:flex; justify-content: center;">
                <form id="form" class="col-sm-12 col-md-10 col-lg-6" method="post"
                    action="{{ route('estates.documents.update', ['estate' => $estate->id, 'document' => $estateDocument->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <strong>تحديث مستند</strong>
                        </div>
                        <div class="card-block">
                            {{-- title --}}
                            <div class="form-group">
                                <label for="title">عنوان المستند<span class="required">*</span></label>
                                <input name="title" type="text" class="form-control" id="title"
                                    placeholder="اسم بسيط للمستند" value="{{ old('title', $estateDocument->title) }}">
                            </div>
                            {{-- / title --}}

                            {{-- description --}}
                            <div class="form-group">
                                <label for="description">وصف المستند</label>
                                <textarea name="description" type="text" class="form-control" id="description" placeholder="وصف دقيق للمستند">{{ old('description', $estateDocument->description) }}</textarea>
                            </div>
                            {{-- / description --}}

                            {{-- file --}}
                            <div class="form-group">
                                <input name="old_file" type="hidden" value="{{old('old_file' , $estateDocument->file)}}">
                                <a href="{{ route('estates.documents.view-file', ['estate' => $estate->id, 'file' => $estateDocument->file]) }}"
                                    style="text-decoration:none" target ="_blank" alt="document file">
                                    @if ($estateDocument->isImage())
                                        <i class="action-icon action-icon--file fa fa-file-image-o fa-lg"></i>
                                    @elseif($estateDocument->isPdf())
                                        <i class="action-icon action-icon--file fa fa-file-pdf-o fa-lg "></i>
                                    @endif
                                </a>
                                <label for="description">الملف <span class="required">*</span></label>
                                <input class="form-control" name="file" type="file" id="file" name="file-input">
                            </div>
                            {{-- / file --}}

                            {{-- buttons --}}
                            <div class="form-group" style="margin-top: 40px">
                                <button id="submit-btn" type="submit" class="btn btn-md btn-success">
                                    <i class="fa fa-edit "></i>
                                    تحديث</button>
                                <a href="{{ route('estates.documents.edit', ['estate' => $estate->id, 'document' => $estateDocument->id]) }}"
                                    class="btn btn-md btn-primary">
                                    <i class="fa fa-refresh "></i>
                                    اعادة</a>
                                <a href="{{$previousURL}}"
                                    class="btn btn-md btn-danger">
                                    <i class="fa fa-ban"></i>
                                    الغاء</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endisset
</div>
@endsection
