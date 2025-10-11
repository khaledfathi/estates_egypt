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
           <div class=" container">
                <div class="manage-btn-box">
                    <a href="{{route('estates.units.utility-services.index', ['estate'=>$estate->id , 'unit'=>$unit->id])}}" class="btn btn-primary">
                        <i class="fa fa-bolt fa-lg "></i> &nbsp; مرافق الوحدة
                    </a>
                </div>
            </div> 
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
                            <ul>
                                <li>رقم الوحدة : {{ $unit->number }}</li><hr>
                                <li>نوع الوحدة {{ $unit->type->toLabel() }}</li><hr>
                                <li>الطابق : {{ $unit->floorNumber == 0 ? 'الارضى' : $unit->floorNumber }}</li><hr>
                                <li>نوع الملكية : {{ $unit->ownershipType->toLabel() }}</li><hr>
                                <li>حالة الاشغال : {{ UnitIsEmpty::from($unit->isEmpty)->toLabel() }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </div>
@endsection
