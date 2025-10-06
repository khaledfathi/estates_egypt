@extends('shared::main-layout')
@section('title', 'الملاك | عرض مالك')
@section('active-owners', 'active')
@section('styles')
    @vite('resources/css/features/owners/show.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/owners/show.ts')
@endsection

@section('content')
    <div class="container-fluid ">

        {{-- Errors --}}
        @if(isset($error) || session()->has('error'))
            <div class="row" style="display:flex; justify-content:center;">
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <div class="card card-inverse card-danger ">
                        <div class="card-block">
                            <ul>
                                @if (isset($error))
                                    <li>{{$error}}</li>
                                @elseif (session('error'))
                                    <li>{{session('error')}}</li>
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

        @isset($owner)
            <div class="row" style="display:flex; justify-content: center;">
                <div id="form" class="col-sm-12 col-md-10 col-lg-6">
                    <div class="card">
                        <div class="edit-box-header">
                            <strong>بيانات المالك</strong>
                            <div>
                                <a style="margin-left:10px;text-decoration:none" href="{{ route('owners.edit', $owner->id) }}">
                                    <i class="action-icon action-icon--edit fa fa-pencil fa-lg "></i>
                                </a>
                                <form class="d-inline" action="{{ route('owners.destroy', $owner->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <i id="delete-owner-btn"
                                        class="action-icon action-icon--delete fa fa-trash fa-lg m-t-2"></i>
                                    <input id="delete-owner-submit-btn" type="submit" hidden>
                                </form>
                            </div>
                        </div>
                        <form class="card-block" method="{{ route('owners.store') }}" method="post">
                            @method('PUT')
                            @csrf
                            {{-- name --}}
                            <div class="form-group">
                                <label for="name">الاسم <span class="required">*</span></label>
                                <input name="name" type="text" class="form-control" id="name"
                                    placeholder="---" value="{{ $owner->name }}" readonly>
                            </div>
                            {{-- / name --}}

                            {{-- national id --}}
                            <div class="form-group">
                                <label for="national_id">الرقم القومى</label>
                                <input name="national_id" type="text" class="form-control" id="national_id"
                                    placeholder="---" value="{{ $owner->nationalId }}" readonly>
                            </div>
                            {{-- / national id --}}

                            {{-- address --}}
                            <div class="form-group">
                                <label for="address">العنوان</label>
                                <textarea name="address" class="form-control " id="address" placeholder="---" readonly>{{ $owner->address }}</textarea>
                            </div>
                            {{-- / address --}}

                            {{-- phones --}}
                            <div id="phone-form-group" class="form-group ">
                                <label>التليفون</label>
                                <div class="form-control readonly-bg">
                                    @if (empty($owner->phones))
                                        <span>---</span>
                                    @else
                                        <ul>
                                            @foreach ($owner->phones as $phone)
                                                <li>{{ $phone->phone }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>

                                @php
                                    $phones = old('phones', []); // Default to one empty input if no old data
                                @endphp
                                @foreach ($phones as $index => $phone)
                                    <div class="phone-box" style="display:flex;align-items:center;gap:10px;margin-bottom:10px">
                                        <input type="text" name="phones[]" value="{{ $phone }}"
                                            class="phones form-control d-inline-block" placeholder="---" disabled />
                                        <i onclick="removeParent(this)" class="fa fa-trash fa-lg"
                                            style="display:inline ; vertical-align: middle; font-size: 1.5rem;color:red;cursor:pointer"
                                            hidden></i>
                                    </div>
                                @endforeach
                            </div>
                            <button id="add-phone-btn" type="button" class="btn" style="margin-bottom: 20px" hidden>اضافة
                                رقم
                            </button>
                            {{-- / phones --}}


                            {{-- notes --}}
                            <div class="form-group">
                                <label for="notes">ملاحظات</label>
                                <textarea name="notes" class="form-control readonly-bg" id="notes"
                                    placeholder="---">{{ $owner->notes }}</textarea>
                            </div>
                            {{-- / notes --}}
                    </div>
                </div>
            </div>
        </div>
    @endisset
    </div>

@endsection
