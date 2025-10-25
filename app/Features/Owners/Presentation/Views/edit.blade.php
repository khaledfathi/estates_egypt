@extends('shared::main-layout')
@section('title', 'الملاك | تحديث المالك')
@section('active-owners', 'active')
@section('scripts')
    @vite('resources/ts/features/owners/edit.ts')
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

        @isset($owner)
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
                <div class="col-sm-12 col-md-10 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>تحديث بيانات المالك</strong>
                        </div>
                        <form class="card-block" method="post" action="{{ route('owners.update', $owner->id) }}">
                            @method('PUT')
                            @csrf
                            {{-- name --}}
                            <div class="form-group">
                                <label for="name">الاسم <span class="required">*</span></label>
                                <input name="name" type="text" class="form-control" id="name"
                                    placeholder="اسم مالك العقار / الوحدة" value="{{ old('name', $owner->name) }}">
                            </div>
                            {{-- / name --}}

                            {{-- national id --}}
                            <div class="form-group">
                                <label for="national_id">الرقم القومى</label>
                                <input name="national_id" type="text" class="form-control" id="national_id" maxlength="14"
                                    placeholder="14 رقم" value={{ old('national_id', $owner->nationalId) }}>
                            </div>
                            {{-- / national id --}}

                            {{-- address --}}
                            <div class="form-group">
                                <label for="address">العنوان</label>
                                <textarea name="address" class="form-control" id="address" placeholder="وصف دقيق للعنوان">{{ old('address', $owner->address) }}</textarea>
                            </div>
                            {{-- / address --}}

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
                                    $phones = old('phones', $ownerPhones);
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


                            {{-- owner  groups --}}
                            @if (count($ownerGroups))
                                <hr>
                                <div id="owner-group-form-group" class="form-group">
                                    <label>المجموعات</label>
                                    {{-- ||| TO BE CLONED |||  --}}
                                    <div class="owner-group-box"
                                        style="display:flex;align-items:center;gap:10px;margin-bottom:10px" hidden>
                                        <select class="owner-groups form-control d-inline-block" name="owner-groups">
                                            @foreach ($ownerGroups as $ownerGroup)
                                                <option value="{{ $ownerGroup->id }}">{{ $ownerGroup->name }}</option>
                                            @endforeach
                                        </select>
                                        <i class="remove-owner-group-btn fa fa-trash fa-lg"
                                            style="display:inline ; vertical-align: middle; font-size: 1.5rem;color:red;cursor:pointer"></i>
                                    </div>
                                    {{-- \ ||| TO BE CLONED |||  --}}

                                    @php
                                        $oldInputOwnerGroups = old('owner_groups', $oldOwnerGroups); // Default to one empty input if no old data
                                    @endphp
                                    @foreach ($oldInputOwnerGroups as $oldOwnerGroupId)
                                        <div class="owner-group-box"
                                            style="display:flex;align-items:center;gap:10px;margin-bottom:10px">
                                            <select class="owner-groups form-control d-inline-block" name="owner_groups[]">
                                                @foreach ($ownerGroups as $ownerGroup)
                                                    <option value="{{ $ownerGroup->id }}"
                                                        {{ $oldOwnerGroupId == $ownerGroup->id ? 'selected' : null }}>
                                                        {{ $ownerGroup->name }}</option>
                                                @endforeach
                                            </select>
                                            <i class="remove-owner-group-buttons fa fa-trash fa-lg"
                                                style="display:inline ; vertical-align: middle; font-size: 1.5rem;color:red;cursor:pointer"></i>
                                        </div>
                                    @endforeach
                                </div>
                                <button id="add-owner-group-btn" type="button" class="btn" style="margin-bottom: 20px">اضافة
                                    مجموعة
                                </button>
                                <hr>
                            @endif
                            {{-- / owner  groups --}}

                            {{-- notes --}}
                            <div class="form-group">
                                <label for="notes">ملاحظات</label>
                                <textarea name="notes" class="form-control" id="notes" placeholder="اى ملاحظات او تفاصيل اخرى عن المالك">{{ old('notes', $owner->notes) }}</textarea>
                            </div>
                            {{-- / notes --}}

                            {{-- buttons --}}
                            <div class="form-group" style="margin-top: 40px">
                                <button id="submit-btn" type="submit" class="btn btn-md btn-success">
                                    <i class="fa fa-edit "></i>
                                    تحديث</button>
                                <a href="{{ route('owners.edit', $owner->id) }}" class="btn btn-md btn-primary">
                                    <i class="fa fa-refresh "></i>
                                    اعادة</a>
                                <a href="{{ $previousURL }}" class="btn btn-md btn-danger">
                                    <i class="fa fa-ban"></i>
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
