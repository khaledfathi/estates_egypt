@php
    use App\Shared\Domain\Enum\Unit\UnitIsEmpty;
@endphp
@extends('shared::main-layout')
@section('title', 'الوحدات | عرض وحدة')
@section('active-estates', 'active')
@section('styles')
    @vite('resources/css/features/units/show.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/units/show.ts')
@endsection

@section('content')
    <div class="container-fluid ">
        {{-- Errors --}}
        @if ($errors->any() || isset($error))
            <div class="row" style="display:flex; justify-content:center;">
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <div class="card card-inverse card-danger">
                        <div class="card-block">
                            <ul>
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                @elseif(isset($error))
                                    <li>{{ $error }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{-- / Errors --}}

        @isset($unit)
            {{-- estaet information  --}}
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
                    <a href="{{ route('estates.show', $estate->id) }}" type="button" class="btn btn-primary">
                        <i class="fa fa-building fa-lg"></i>&nbsp; الذهاب للعقار</a>
                    <a href="{{ route('estates.units.index',  $estate->id ) }}" type="button"
                        class="btn btn-primary">
                        <i class="fa fa-list fa-lg "></i> &nbsp; الذهاب لقائمة وحدات العقار</a>
                </div>
            </div>
            {{-- / estaet information  --}}

            <div class="row" style="display:flex; justify-content: center;">
                <div id="form" class="col-sm-12 col-md-10 col-lg-6">
                    <div class="card">
                        <div class="edit-box-header">
                            <strong>بيانات الوحدة</strong>
                            <div>
                                <a style="margin-left:10px;text-decoration:none" href="{{ route('estates.units.edit', ['estate' => $estate->id ,'unit'=> $unit->id]) }}">
                                    <i class="action-icon action-icon--edit fa fa-pencil fa-lg "></i>
                                </a>
                                <form class="d-inline" action="{{ route('estates.units.destroy',['estate'=> $estate->id , 'unit' => $unit->id] ) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <i id="delete-owner-btn"
                                        class="action-icon action-icon--delete fa fa-trash fa-lg m-t-2"></i>
                                    <input id="delete-owner-submit-btn" type="submit" hidden>
                                </form>
                            </div>
                        </div>
                        <div class="card-block">
                            @csrf
                            {{-- type --}}
                            <div class="form-group">
                                <label for="type">نوع الوحدة </label>
                                <input type="text" name="type" class="form-control " id="type" placeholder="---"
                                    readonly value="{{ $unit->type->toLabel() }}">
                            </div>
                            {{-- / type --}}

                            {{-- number --}}
                            <div class="form-group">
                                <label for="number">رقم الوحدة</label>
                                <input type="text" name="type" class="form-control " id="type" placeholder="---"
                                    readonly value = "{{ $unit->number }}">
                            </div>
                            {{-- / number --}}

                            {{-- floor number --}}
                            <div class="form-group">
                                <label for="floor_number">الطابق</label>
                                <input type="text" name="floor_number" class="form-control " id="floor_number"
                                    placeholder="---" readonly
                                    value="{{ $unit->floorNumber == 0 ? 'الارضى' : $unit->floorNumber }}">
                            </div>
                            {{-- / floor number --}}

                            {{-- ownershipe type --}}
                            <div class="form-group">
                                <label for="ownership_type">نوع الملكية</label>
                                <input type="text" name="ownership_type" class="form-control " id="ownership_type"
                                    placeholder="---" readonly value="{{ $unit->ownershipType->toLabel() }}">
                            </div>
                            {{-- / ownershipe type --}}

                            {{-- is empty --}}
                            <div class="form-group">
                                <label for="is_empty">حالة الاشغال</label>
                                <input type="" name="is_empty" class="form-control " id="is_empty" placeholder="---"
                                    readonly value="{{ UnitIsEmpty::from($unit->isEmpty)->toLabel() }}">
                            </div>
                            {{--  / is empty --}}

                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </div>
@endsection
