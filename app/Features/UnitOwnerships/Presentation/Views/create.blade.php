@extends('shared::main-layout')
@section('title', 'الوحدات | تسجيل مالك')
@section('active-estates', 'active')

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
                    <a href="{{ route('estates.show', $estate->id) }}" type="button" class="btn btn-primary">
                        <i class="fa fa-building fa-lg"></i>&nbsp; الذهاب للعقار</a>
                    <a href="{{ route('estates.units.index', $estate->id) }}" type="button" class="btn btn-primary">
                        <i class="fa fa-list fa-lg "></i> &nbsp; الذهاب لقائمة وحدات العقار</a>
                    <a href="{{ route('estates.units.show', ['estate' => $estate->id, 'unit' => $unit->id]) }}"
                        type="button" class="btn btn-primary">
                        <i class="fa fa-home fa-lg"></i> &nbsp; الذهاب للوحدة</a>
                </div>
            </div>
        @endif
        {{-- / unit information --}}

        @isset($unit)
            <div class="row" style="display:flex; justify-content: center;">
                <form id="form" class="col-sm-12 col-md-10 col-lg-6" method="post"
                    action="{{ route('estates.units.ownerships.store', ['estate' => $estate->id, 'unit' => $unit->id]) }}">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <strong>تسجيل مالك للوحدة </strong>
                        </div>
                        <div class="card-block">

                            {{-- owner name --}}
                            <div class="form-group">
                                <label for="owner_id">اسم المالك <span class="required">*</span></label>
                                <select id="owner_id" name="owner_id" class="form-control" size="1">
                                    @foreach ($owners as $owner)
                                        <option value="{{$owner->id}}">
                                            {{ $owner->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- / owner name --}}

                            {{-- buttons --}}
                            <div class="form-group" style="margin-top: 40px">
                                <button id="submit-btn" type="submit" class="btn btn-md btn-success">
                                    <i class="fa fa-plus-circle "></i>
                                    اضافة</button>
                                <a href="{{ route('estates.units.show', ['estate' => $estate->id, 'unit' => $unit->id]) }}"
                                    class="btn btn-md btn-danger"><i class="fa fa-ban"></i>
                                    الغاء</a>
                            </div>
                            {{-- / buttons --}}
                        </div>
                    </div>
                </form>
            </div>
        @endisset
</div>
@endsection
