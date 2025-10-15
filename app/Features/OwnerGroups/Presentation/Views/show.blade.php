@extends('shared::main-layout')
@section('title', 'مجموعة الملاك | عرض مجموعة ')
@section('active-owners', 'active')
@section('scripts')
    @vite('resources/ts/features/owners/create.ts')
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
                <a href="{{route('owner-groups.index')}}" class="btn btn-md btn-primary my-5">
                    <i class="fa fa-users fa-lg d-inline-block"></i>
                    <span> المجموعات </span>
                </a>
                <a href="{{ route('owners.index') }}" class="btn btn-md btn-primary my-5">
                    <i class="icon-people fa-lg d-inline-block"></i>
                    <span> الملاك </span>
                </a>
                <div class="row" style="display:flex; justify-content: center;">
                    <div id="" class="col-sm-12 col-md-10 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <strong>بيانات المجموعة</strong>
                            </div>
                            <div class="card-block">
                                <ul>
                                    <li>اسم المجموعة : {{ $ownerGroup->name }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset

    </div>

@endsection
