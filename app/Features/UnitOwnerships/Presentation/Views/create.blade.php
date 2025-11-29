@extends('shared::main-layout')
@section('title', 'الوحدات | تسجيل الملاك')
@section('active-estates', 'active')
@section('breadcrumbs')
    @isset($unit)
        {{ Diglactic\Breadcrumbs\Breadcrumbs::render('estates.units.ownerships.create', $estate->id, $unit->id) }}
    @endisset
@endsection
@section('scripts')
    @vite('resources/ts/features/unit-ownerships/create.ts');
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

        {{-- unit information  --}}
        @if (isset($estate) && isset($unit))
            <div class="card">
                <div class="card-header">
                    بيانات الوحدة
                </div>
                <div class="card-block">
                    <ul>
                        <li>تنتمى للعقار : {{ $estate->name }}</li>
                        <li> العنوان :
                            <pre>{{ $estate->address }}</pre>
                        </li>
                        <hr>
                        <li> رقم الوحدة : {{ $unit->number }} ---
                            الطابق : {{ $unit->floorNumber == 0 ? 'الارضى' : $unit->floorNumber }} ---
                            نوع الوحدة : {{ $unit->type->toLabel() }}
                        </li>

                    </ul>
                </div>
            </div>
        @endif
        {{-- / unit information --}}

        @isset($unit)
            <div class="row" style="display:flex; justify-content: center;">
                <div id="" class="col-sm-12 col-md-10 col-lg-6" method="post">
                    @csrf
                    {{-- store options --}}
                    <div class="form-group row" style="text-align:center">
                        <div class="col">
                            <label class="radio-inline" for="inline-radio1">
                                <input type="radio" id="inline-radio1" name="store-option" value="owners-list" checked>
                                مالك / ملاك
                            </label>
                            <label class="radio-inline" for="inline-radio3" style="margin-right:20px">
                                <input type="radio" id="inline-radio3" name="store-option" value="groups-of-owners">
                                مجموعة ملاك
                            </label>
                        </div>
                    </div>
                    {{-- store options --}}

                    <div class="card">
                        <div class="card-header">
                            <strong>تسجيل مالك / ملاك للوحدة </strong>
                        </div>

                        {{-- OWNERS LIST OPTION --}}
                        <form class="card-block" id ="owners-list-section" method="post"
                            action="{{ route('estates.units.ownerships.store', ['estate' => $estate->id, 'unit' => $unit->id]) }}"
                            hidden>
                            @csrf
                            {{-- option type  --}}
                            <input type="hidden" name="store_type" value="owners_list">
                            {{-- / option type  --}}

                            {{-- owner name --}}
                            <div class="form-group">
                                <label for="owner_id">اسم المالك <span class="required">*</span></label>
                                <select id="owner_id" name="owners[]" class="form-control" size="1">
                                    @foreach ($owners as $owner)
                                        <option value="{{ $owner->id }}">
                                            {{ $owner->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- / owner name --}}

                            {{-- || TO BE CLONED (owners-list) || --}}
                            <div id="owner-parent-div">
                                <div class="owner-box" style="display:flex;align-items:center;gap:10px;margin-bottom:10px">
                                    <select class="owners-select form-control d-inline-block">
                                        @foreach ($owners as $owner)
                                            <option value="{{ $owner->id }}">
                                                {{ $owner->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <i class="remove-owner-btn fa fa-trash fa-lg"
                                        style="display:inline ; vertical-align: middle; font-size: 1.5rem;color:red;cursor:pointer"></i>
                                </div>
                            </div>
                            <button id="add-owner-btn" type="button" class="btn" style="margin-bottom: 20px">اضافة
                                مالك
                            </button>
                            {{-- / || TO BE CLONED (owners-list) || --}}

                            {{-- buttons --}}
                            <div class="form-group" style="margin-top: 40px">
                                <button id="submit-btn" type="submit" class="btn btn-md btn-success">
                                    <i class="fa fa-plus-circle "></i>
                                    تسجيل</button>
                                <a href="{{ route('estates.units.show', ['estate' => $estate->id, 'unit' => $unit->id]) }}"
                                    class="btn btn-md btn-danger"><i class="fa fa-ban"></i>
                                    الغاء</a>
                            </div>
                            {{-- / buttons --}}
                        </form>
                        {{-- / OWNERS LIST OPTION --}}

                        {{-- GROUPS OF OWNERS OPTION --}}
                        <form class="card-block" id="groups-of-owners-section" method="post"
                            action="{{ route('estates.units.ownerships.store', ['estate' => $estate->id, 'unit' => $unit->id]) }}"
                            hidden>
                            @csrf
                            {{-- option type  --}}
                            <input type="hidden" name="store_type" value="owners_groups">
                            {{-- / option type  --}}

                            {{-- owner name --}}
                            <div class="form-group">
                                <label for="owner_id">اسم المجموعة <span class="required">*</span></label>
                                <select id="owner_id" name="groups[]" class="form-control" size="1">
                                    @foreach ($ownerGroups as $ownerGroup)
                                        <option value="{{ $ownerGroup->id }}">
                                            {{ $ownerGroup->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- / owner name --}}

                            {{-- adding groups section  --}}

                            {{-- || TO BE CLONED ( groups-of-owners section) || --}}
                            <div id="groups-parent-div">
                                <div class="groups-box"
                                    style="display:flex;align-items:center;gap:10px;margin-bottom:10px" hidden>
                                    <select class="groups-select form-control d-inline-block" name="groups[]">
                                        @foreach ($ownerGroups as $ownerGroup)
                                            <option value="{{ $ownerGroup->id }}">
                                                {{ $ownerGroup->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <i class="remove-group-btn fa fa-trash fa-lg"
                                        style="display:inline ; vertical-align: middle; font-size: 1.5rem;color:red;cursor:pointer"></i>
                                </div>
                            </div>
                            {{-- / || TO BE CLONED ( groups-of-owners section )  || --}}
                            <button id="add-group-btn" type="button" class="btn" style="margin-bottom: 20px">اضافة
                                مجموعة
                            </button>
                            {{-- / adding groups section  --}}

                            {{-- buttons --}}
                            <div class="form-group" style="margin-top: 40px">
                                <button id="submit-btn" type="submit" class="btn btn-md btn-success">
                                    <i class="fa fa-plus-circle "></i>
                                    تسجيل</button>
                                <a href="{{ route('estates.units.show', ['estate' => $estate->id, 'unit' => $unit->id]) }}"
                                    class="btn btn-md btn-danger"><i class="fa fa-ban"></i>
                                    الغاء</a>
                            </div>
                            {{-- / buttons --}}

                        </form>
                        {{-- / GROUPS OF OWNERS OPTION --}}
                    </div>
                </div>
            </div>
        @endisset
</div>
@endsection
