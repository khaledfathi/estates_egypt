@extends('shared::main-layout')
@section('title', 'الوحدات | تحديث وحدة')
@section('active-estates', 'active')
@section('breadcrumbs')
    @isset($unit)
        {{ Diglactic\Breadcrumbs\Breadcrumbs::render('estates.units.edit', $estate->id , $unit->id) }}
    @endisset
@endsection
@section('content')
    <div class="container-fluid ">
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

        @if ($found)
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
                            <li> العنوان :
                                <pre>{{ $estate->address }}</pre>
                            </li>
                        </ul>
                    </div>
                </div>
            @endisset
            {{-- / estaet information  --}}

            <div class="row" style="display:flex; justify-content: center;">
                <form id="form" class="col-sm-12 col-md-10 col-lg-6" method="post"
                    action="{{ route('estates.units.update', ['estate'=>$estate->id, 'unit'=>$unit->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <strong>تحديث بيانات الوحدة</strong>
                        </div>
                        <div class="card-block">

                            {{-- number --}}
                            <div class="form-group">
                                <label for="number">رقم الوحدة<span class="required">*</span></label>
                                <input name="number" type="text" class="form-control" id="number"
                                    placeholder="رقم اكبر من الصفر" value="{{ old('number', $unit->number) }}">
                            </div>
                            {{-- / number --}}

                            {{-- unit type --}}
                            <div class="form-group">
                                <label for="type">نوع الوحدة<span class="required">*</span></label>
                                <select id="type" name="type" class="form-control" size="1">
                                    @foreach ($unitTypes as $value => $label)
                                        <option value="{{ $value }}"
                                            {{ old('type', $unit->type->value) == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- unit type --}}

                            {{-- floor number --}}
                            <div class="form-group">
                                <label for="floor_number">الطابق<span class="required">*</span></label>
                                <select id="floor_number" name="floor_number" class="form-control" size="1">
                                    @for ($i = 0; $i < $estate->floorCount; $i++)
                                        <option value="{{ $i }}"
                                            {{ old('floor_number', $unit->floorNumber) == $i ? 'selected' : '' }}>
                                            {{ $i == 0 ? 'الارضى' : $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            {{-- / floor number --}}

                            {{--  is empty --}}
                            <div class="form-group">
                                <label for="is_empty">حالة الاشغال<span class="required">*</span></label>
                                <select id="is_empty" name="is_empty" class="form-control" size="1">
                                    @foreach ($unitIsEmptyLabels as $value => $label)
                                        <option value="{{ $value ? 'true' : 'false' }}"
                                            {{ old('is_empty', $unit->isEmpty ? 'true' : 'false') === ($value ? 'true' : 'false') ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- / is empty --}}

                            {{-- buttons --}}
                            <div class="form-group" style="margin-top: 40px">
                                <button id="submit-btn" type="submit" class="btn btn-md btn-success">
                                     <i class="fa fa-edit "></i>
                                    تحديث</button>
                                <a href="{{ route('estates.units.edit', ['estate'=>$estate->id , 'unit'=>$unit->id]) }}" class="btn btn-md btn-primary">
                                    <i class="fa fa-refresh "></i> 
                                    اعادة</a>
                                <a href="{{$previousURL}}"
                                    class="btn btn-md btn-danger">
                                    <i class="fa fa-ban"></i>
                                    الغاء</a>
                            </div>
                            {{-- / buttons --}}
                        </div>
                    </div>
                </form>
            </div>
        @endif
</div>
@endsection
