@extends('shared::main-layout')
@section('title', 'مجموعة الملاك | تعديل مجموعة')
@section('active-owners', 'active')
@section('scripts')
    @vite('resources/ts/features/owner-groups/create.ts')
@endsection

@section('content')
    <div class="container-fluid ">

        {{-- Errors --}}
        @if ($errors->any() || isset($error))
            <div class="row" style="display:flex; justify-content:center;">
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <div class="card card-inverse card-danger ">
                        <div class="card-block">
                            <ul>
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                @elseif (isset($error))
                                    <li>{{ $error }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{-- / Errors --}}

        @isset($ownerGroup)
            <div class="container-fluid">

                <a href="{{ route('owner-groups.index') }}" class="btn btn-md btn-primary my-5">
                    <i class="fa fa-users fa-lg d-inline-block"></i>
                    <span> المجموعات </span>
                </a>
                <a href="{{ route('owners.index') }}" class="btn btn-md btn-primary my-5">
                    <i class="icon-people fa-lg d-inline-block"></i>
                    <span> الملاك </span>
                </a>
                <div class="row" style="display:flex; justify-content: center;">
                    <form id="form" class="col-sm-12 col-md-10 col-lg-6" method="post"
                        action="{{ route('owner-groups.update', $ownerGroup->id) }}">
                        @csrf
                        @method('put')
                        <div class="card">
                            <div class="card-header">
                                <strong>تحديث بيانات المجموعة</strong>
                            </div>
                            <div class="card-block">
                                {{-- name --}}
                                <div class="form-group">
                                    <label for="name">اسم المجموعة <span class="required">*</span></label>
                                    <input name="name" type="text" class="form-control" id="name"
                                        placeholder="اسم المجموعة" value="{{ old('name', $ownerGroup->name) }}">
                                </div>
                                {{-- / name --}}

                                {{-- buttons --}}
                                <div class="form-group" style="margin-top: 40px">
                                    <button id="submit-btn" type="submit" class="btn btn-md btn-success">
                                        <i class="fa fa-edit "></i>
                                        تحديث</button>
                                    <a href="{{ route('owner-groups.edit', $ownerGroup->id) }}" class="btn btn-md btn-primary">
                                        <i class="fa fa-refresh "></i>
                                        اعادة</a>
                                    <a href="{{ route('owner-groups.index', $ownerGroup->id) }}" class="btn btn-md btn-danger">
                                        <i class="fa fa-ban"></i>
                                        الغاء</a>
                                </div>
                                {{-- / buttons --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endisset

    </div>

@endsection
