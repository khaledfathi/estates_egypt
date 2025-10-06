@extends('shared::main-layout')
@section('title', 'الملاك | اضافة مالك')
@section('active-owners', 'active')
@section('scripts')
    @vite('resources/ts/features/owners/create.ts')
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

        <div class="row" style="display:flex; justify-content: center;">
            <form id="form" class="col-sm-12 col-md-10 col-lg-6" method="post" action="{{ route('owners.store') }}">
                <div class="card">
                    <div class="card-header">
                        <strong>اضافة مالك</strong>
                    </div>
                    <div class="card-block">
                        @csrf

                        {{-- name --}}
                        <div class="form-group">
                            <label for="name">الاسم <span class="required">*</span></label>
                            <input name="name" type="text" class="form-control" id="name"
                                placeholder="اسم مالك العقار / الوحدة" value="{{ old('name') }}">
                        </div>
                        {{-- / name --}}

                        {{-- national id --}}
                        <div class="form-group">
                            <label for="national_id">الرقم القومى</label>
                            <input name="national_id" type="text" class="form-control" id="national_id" maxlength="14"
                                placeholder="14 رقم" value={{ old('national_id') }}>
                        </div>
                        {{-- / national id --}}

                        {{-- address --}}
                        <div class="form-group">
                            <label for="address">العنوان</label>
                            <textarea name="address" class="form-control" id="address" placeholder="وصف دقيق للعنوان">{{ old('address') }}</textarea>
                        </div>
                        {{-- / address --}}

                        {{-- phones --}}
                        <div id="phone-form-group" class="form-group">
                            <label>التليفون</label>
                            {{-- ||| TO BE CLONED |||  --}}
                            <div class="phone-box" style="display:flex;align-items:center;gap:10px;margin-bottom:10px"
                                hidden>
                                <input type="text" class="phones form-control d-inline-block"
                                    placeholder="رقم التليفون" maxlength="25">
                                <i class="remove-phone-btn fa fa-trash fa-lg"
                                    style="display:inline ; vertical-align: middle; font-size: 1.5rem;color:red;cursor:pointer"></i>
                            </div>
                            {{-- \ ||| TO BE CLONED |||  --}}

                            @php
                                $phones = old('phones', []); // Default to one empty input if no old data
                            @endphp
                            @foreach ($phones as $index => $phone)
                            <div class="phone-box" style="display:flex;align-items:center;gap:10px;margin-bottom:10px">
                                <input type="text" name="phones[]" value="{{ $phone }}"  class="phones form-control d-inline-block" placeholder="رقم التليفون" maxlength="25"/>
                                <i class="remove-phone-btn fa fa-trash fa-lg"
                                    style="display:inline ; vertical-align: middle; font-size: 1.5rem;color:red;cursor:pointer"></i>
                            </div>
                            @endforeach
                        </div>
                        <button id="add-phone-btn" type="button" class="btn" style="margin-bottom: 20px">اضافة رقم
                        </button>
                        {{-- / phones --}}


                        {{-- notes --}}
                        <div class="form-group">
                            <label for="notes">ملاحظات</label>
                            <textarea name="notes" class="form-control" id="notes" placeholder="اى ملاحظات او تفاصيل اخرى عن المالك">{{ old('notes') }}</textarea>
                        </div>
                        {{-- / notes --}}

                        {{-- buttons --}}
                        <div class="form-group" style="margin-top: 40px">
                            <button id="submit-btn" type="submit" class="btn btn-md btn-success">
                                <i class="fa fa-plus-circle "></i>
                                اضافة</button>
                            <a href="{{ route('owners.index') }}" class="btn btn-md btn-danger"><i class="fa fa-ban"></i>
                                الغاء</a>
                        </div>
                        {{-- / buttons --}}
                    </div>
                </div>
            </form>
        </div>

    </div>

@endsection
