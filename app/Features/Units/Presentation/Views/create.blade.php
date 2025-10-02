@extends('shared::main-layout')
@section('title', 'الوحدات | اضافة وحدة')
@section('active-estates', 'active')

@section('content')
    <div class="container-fluid ">

        {{-- Errors --}}
        @if ($errors->any() || session()->has('error'))
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
                        <li>عدد الوحدات : {{ $estate->unitCount }} ( سكنى {{ $estate->residentialUnitCount }} ) - ( تجارى
                            {{ $estate->commercialUnitCount }})</li>
                    </ul>
                    <a href="{{ route('estates.show', $estate->id) }}" type="button" class="btn btn-primary">
                        <i class="fa fa-building fa-lg"></i>&nbsp; الذهاب للعقار</a>
                    <a href="{{ route('estates.units.index', $estate->id) }}" type="button"
                        class="btn btn-primary">
                        <i class="fa fa-list fa-lg "></i> &nbsp; الذهاب لقائمة وحدات العقار</a>
                </div>
            </div>
        @endisset
        {{-- / estaet information  --}}

        <div class="row" style="display:flex; justify-content: center;">
            <form id="form" class="col-sm-12 col-md-10 col-lg-6" method="post"
                action="{{ route('estates.units.store' , $estate->id)  }}">
                <div class="card">
                    <div class="card-header">
                        <strong>اضافة وحدة</strong>
                    </div>
                    <div class="card-block">
                        @csrf
                        {{-- unit type --}}
                        <div class="form-group">
                            <label for="type">نوع الوحدة<span class="required">*</span></label>
                            <select id="type" name="type" class="form-control" size="1">
                                @foreach ($unitTypes as $value => $label)
                                    <option value="{{ $value }}" {{ old('type') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- unit type --}}

                        {{-- number --}}
                        <div class="form-group">
                            <label for="number">رقم الوحدة<span class="required">*</span></label>
                            <input name="number" type="text" class="form-control" id="number"
                                placeholder="رقم اكبر من الصفر" value="{{ old('number') }}">
                        </div>
                        {{-- / number --}}

                        {{-- floor number --}}
                        <div class="form-group">
                            <label for="floor_number">الطابق<span class="required">*</span></label>
                            <select id="floor_number" name="floor_number" class="form-control" size="1">
                                @for ($i = 0; $i < $estate->floorCount; $i++)
                                    <option value="{{ $i }}"
                                        {{ old('floor_number') == $i ? 'selected' : '' }}>
                                        {{ $i == 0 ? 'الارضى' : $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        {{-- / floor number --}}

                        {{-- ownershipe type --}}
                        <div class="form-group">
                            <label for="ownership_type">نوع الملكية<span class="required">*</span></label>
                            <select id="ownership_type" name="ownership_type" class="form-control" size="1">
                                @foreach ($unitOwnershipTypes as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ old('ownership_type') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- / ownershipe type --}}

                        {{--  is empty --}}
                        <div class="form-group">
                            <label for="is_empty">حالة الاشغال<span class="required">*</span></label>
                            <select id="is_empty" name="is_empty" class="form-control" size="1">
                                @foreach ($unitIsEmptyLabels as $value => $label)
                                    <option value="{{ $value ? 'true' : 'false' }}"
                                        {{ old('is_empty') === ($value ? 'true' : 'false') ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- / is empty --}}


                        {{-- buttons --}}
                        <div class="form-group" style="margin-top: 40px">
                            <button id="submit-btn" type="submit" class="btn btn-md btn-success"><i
                                    class="fa fa-dot-circle-o"></i>
                                اضافة</button>
                            <a href="{{route('estates.units.index', $estate->id)}}" class="btn btn-md btn-danger"><i class="fa fa-ban"></i>
                                الغاء</a>
                        </div>
                        {{-- / buttons --}}
                    </div>
                </div>
            </form>
        </div>

</div>
@endsection
