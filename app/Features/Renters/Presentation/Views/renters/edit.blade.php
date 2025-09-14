@extends('main-layout')
@section('title', ' المستأجرين | تحديث بيانات مستأجر')
@section('title', 'المستأجرين')
@section('active-renters', 'active')
@section('scripts')
    @vite('resources/ts/features/renters/create.ts')
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
                                @if ($errors->all())
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                @elseif ($error)
                                    <li>{{ $error }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{-- / Errors --}}

        @isset($renter)
            <div class="row" style="display:flex; justify-content: center;">
                <div id="form" class="col-sm-12 col-md-10 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>اضافة مستأجر</strong>
                        </div>
                        <form class="card-block" method="post" action="{{ route('renters.update', $renter->id) }}">
                            @method('put')
                            @csrf
                            {{-- name --}}
                            <div class="form-group">
                                <label for="name">الاسم <span class="required">*</span></label>
                                <input name="name" type="text" class="form-control" id="name"
                                    placeholder="اسم المستأجر " value="{{ old('name', $renter->name) }}">
                            </div>
                            {{-- / name --}}

                            {{-- identity type --}}
                            <div class="form-group">
                                <label for="identity_type">نوع الهوية <span class="required">*</span></label>
                                <select id="identity_type" name="identity_type" class="form-control" size="1">
                                    @foreach ($renterIdentityTypes as $value => $label)
                                        <option value="{{ $value }}"
                                            {{ old('identity_type', $renter->identityType->value == $value) == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>{{-- / identity type --}}

                            {{-- identity number --}}
                            <div class="form-group">
                                <label for="identity_number">رقم الهوية <span class="required">*</span></label>
                                <input name="identity_number" type="text" class="form-control" id="identity_number"
                                    maxlength="14" placeholder="رقم الهوية "
                                    value={{ old('identity_number', $renter->identityNumber) }}>
                            </div>
                            {{-- / identity number --}}

                            {{-- phones --}}
                            <div id="phone-form-group" class="form-group">
                                <label>التليفون</label>
                                {{-- ||| TO BE CLONED |||  --}}
                                <div class="phone-box" style="display:flex;align-items:center;gap:10px;margin-bottom:10px"
                                    hidden>
                                    <input type="text" class="phones form-control d-inline-block" placeholder="رقم التليفون"
                                        maxlength="25">
                                    <i class="remove-phone-btn fa fa-trash fa-lg"
                                        style="display:inline ; vertical-align: middle; font-size: 1.5rem;color:red;cursor:pointer"></i>
                                </div>
                                {{-- \ ||| TO BE CLONED |||  --}}

                                @php
                                    $phones = old('phones', $renterPhones); // Default to one empty input if no old data
                                @endphp
                                @foreach ($phones as $index => $phone)
                                    <div class="phone-box" style="display:flex;align-items:center;gap:10px;margin-bottom:10px">
                                        <input type="text" name="phones[]" value="{{ $phone }}"
                                            class="phones form-control d-inline-block" placeholder="رقم التليفون"
                                            maxlength="25" />
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
                                <textarea name="notes" class="form-control" id="notes" placeholder="اى ملاحظات او تفاصيل اخرى عن المستأجر">{{ old('notes', $renter->notes) }}</textarea>
                            </div>
                            {{-- / notes --}}

                            {{-- buttons --}}
                            <div class="form-group" style="margin-top: 40px">
                                <button id="submit-btn" type="submit" class="btn btn-md btn-success"><i
                                        class="fa fa-dot-circle-o"></i>
                                    تحديث</button>
                                <a href="{{ route('renters.edit', $renter->id) }}" class="btn btn-md btn-primary"><i
                                        class="fa fa-ban"></i>
                                    اعادة</a>
                                <a href="{{ $previousURL }}" class="btn btn-md btn-danger"><i class="fa fa-ban"></i>
                                    الغاء</a>
                            </div>
                            {{-- / buttons --}}
                        </form>
                    </div>
                </div>
            </div>
        @endisset
    </div>

@endsection
