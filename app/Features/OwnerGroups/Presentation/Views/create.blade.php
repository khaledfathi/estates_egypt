@extends('shared::main-layout')
@section('title', 'مجموعة الملاك | اضافة مجموعة')
@section('active-owners', 'active')
@section('scripts')
    @vite('resources/ts/features/owner-groups/create.ts')
@endsection

@section('content')
    <div class="container-fluid ">

        {{-- Errors --}}
        @if ($errors->any())
            <div class="row" style="display:flex; justify-content:center;">
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <div class="card card-inverse card-danger ">
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

        {{-- header buttons section --}}
        <div class="container">
            <a href="{{ route('owners.index') }}" class="btn btn-md btn-secondary my-5">
                <i class="icon-people fa-lg d-inline-block"></i>
                <span>الملاك</span>
            </a>
            <a href="{{ route('owner-groups.index') }}" class="btn btn-md btn-secondary my-5">
                <i class="fa fa-users fa-lg d-inline-block"></i>
                <span>المجموعات</span>
            </a>
        </div>
        <hr>
        {{-- / header buttons section --}}

        <div class="row" style="display:flex; justify-content: center;">
            <form id="form" class="col-sm-12 col-md-10 col-lg-6" method="post"
                action="{{ route('owner-groups.store') }}">
                <div class="card">
                    <div class="card-header">
                        <strong>اضافة مجموعة</strong>
                    </div>
                    <div class="card-block">
                        @csrf

                        {{-- name --}}
                        <div class="form-group">
                            <label for="name">اسم المجموعة <span class="required">*</span></label>
                            <input name="name" type="text" class="form-control" id="name"
                                placeholder="اسم المجموعة" value="{{ old('name') }}">
                        </div>
                        {{-- / name --}}

                        {{-- buttons --}}
                        <div class="form-group" style="margin-top: 40px">
                            <button id="submit-btn" type="submit" class="btn btn-md btn-success">
                                <i class="fa fa-plus-circle "></i>
                                اضافة</button>
                            <a href="{{ route('owner-groups.index') }}" class="btn btn-md btn-danger"><i
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
