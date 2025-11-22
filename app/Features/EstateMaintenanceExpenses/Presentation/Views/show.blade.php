@php
    use App\Shared\Domain\Enum\Unit\UnitIsEmpty;
@endphp
@extends('shared::main-layout')
@section('title', 'الحسابات | عرض مصروف صيانة')
@section('active-accounting', 'active')
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

        @isset($estateMaintenanceExpense)
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
                    <a href="{{ route('maintenance-expenses.index') }}" type="button" class="btn btn-primary">
                        <i class="fa fa-dollar fa-lg"></i> &nbsp; الذهاب لصفحة مصروفات الصيانة</a>
                </div>
            </div>
            {{-- / estaetapp/Features/EstateMaintenanceExpenses/Presentation/Views/create.blade.php information  --}}


            {{-- estate maintenance expense --}}
            <div class="row" style="display:flex; justify-content: center;">
                <div id="form" class="col-sm-12 col-md-10 col-lg-6">
                    <div class="card">
                        <div class="edit-box-header">
                            <strong> بيانات مصروف صيانة</strong>
                            <div>
                                <a style="margin-left:10px;text-decoration:none"
                                    href="{{ route('estates-maintenance-expenses.edit' , ['estates_maintenance_expense' => $estateMaintenanceExpense->id]) }}">
                                    <i class="action-icon action-icon--edit fa fa-pencil fa-lg "></i>
                                </a>
                                <form class="d-inline"
                                    action="{{ route('estates-maintenance-expenses.destroy' , ['estates_maintenance_expense' => $estateMaintenanceExpense->id , 'estate_id'=>$estateMaintenanceExpense->estateId]) }}"
                                    method="post">
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
                                <li>تاريخ العملية : {{ $estateMaintenanceExpense->transaction->date->toDateString()}}</li>
                                <hr>
                                <li>تاريخ العملية : {{ abs($estateMaintenanceExpense->transaction->amount)}}</li>
                                <hr>
                                <li>مدفوع لـ : {{ $estateMaintenanceExpense->title}}</li>
                                <hr>
                                <li>وصف تفصيلى: <pre>{{ $estateMaintenanceExpense->title}}</pre></li>
                                <hr>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- estate maintenance expense --}}
        @endisset
    </div>
@endsection
