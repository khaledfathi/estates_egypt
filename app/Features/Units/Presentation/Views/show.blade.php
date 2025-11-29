@php
    use App\Shared\Domain\Enum\Unit\UnitIsEmpty;
@endphp
@extends('shared::main-layout')
@section('title', 'الوحدات | عرض وحدة')
@section('active-estates', 'active')
@section('breadcrumbs')
    @isset($unit)
        {{ Diglactic\Breadcrumbs\Breadcrumbs::render('estates.units.show', $estate->id  , $unit->id) }}
    @endisset
@endsection
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
                </div>
            </div>
            {{-- / estaet information  --}}
            <div class=" container">
                <div class="manage-btn-box">
                    <a href="{{ route('estates.units.utility-services.index', ['estate' => $estate->id, 'unit' => $unit->id]) }}"
                        class="btn btn-primary">
                        <i class="fa fa-bolt fa-lg "></i> &nbsp; مرافق الوحدة
                    </a>
                    <a href="{{ route('estates.units.ownerships.create', ['estate' => $estate->id, 'unit' => $unit->id]) }}"
                        class="btn btn-primary">
                        <i class="icon-people fa-lg"></i>&nbsp; تسجيل مالك/ملاك الوحدة
                    </a>
                    <a href="{{ route('estates.units.contracts.index', ['estate'=> $estate->id, 'unit' => $unit->id, ]) }}"
                        class="btn btn-primary">
                        <i class="icon-layers icons fa-lg"></i> &nbsp; سجل التعاقدات 
                    </a>
                </div>
            </div>
            <div class="row" style="display:flex; justify-content: center;">
                <div id="form" class="col-sm-12 col-md-10 col-lg-6">
                    <div class="card">
                        <div class="edit-box-header">
                            <strong>بيانات الوحدة</strong>
                            <div>
                                <a style="margin-left:10px;text-decoration:none"
                                    href="{{ route('estates.units.edit', ['estate' => $estate->id, 'unit' => $unit->id]) }}">
                                    <i class="action-icon action-icon--edit fa fa-pencil fa-lg "></i>
                                </a>
                                <form class="d-inline"
                                    action="{{ route('estates.units.destroy', ['estate' => $estate->id, 'unit' => $unit->id]) }}"
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
                                <li>رقم الوحدة : {{ $unit->number }}</li>
                                <hr>
                                <li>نوع الوحدة {{ $unit->type->toLabel() }}</li>
                                <hr>
                                <li>الطابق : {{ $unit->floorNumber == 0 ? 'الارضى' : $unit->floorNumber }}</li>
                                <hr>
                                <li>حالة الاشغال : {{ UnitIsEmpty::from($unit->isEmpty)->toLabel() }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- owners  list  --}}
            @if (count($unit->owners))
                <hr>
                <div class ="container-fluid ">
                    <h5 style="text-align:center">قائمة الملاك</h5>
                    <div class="card-block">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>اسم المالك</th>
                                    <th>الرقم القومى</th>
                                    <th>تليفون</th>
                                    <th width="10%">صفحة المالك</th>
                                    <th width="10%">حذف الملكية</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unit->owners as $owner)
                                    <tr>
                                        <td>{{ $owner->name }}</td>
                                        <td>{{ $owner->nationalId ?? '----' }}</td>
                                        <td>
                                            @if (!count($owner->phones))
                                                ----
                                            @else
                                                @foreach ($owner->phones as $phone)
                                                    {{ $phone }}<br>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td><a href="{{ route('owners.show', $owner->id) }}">
                                                <i class="action-icon fa fa-external-link fa-lg m-t-2"></i>
                                            </a></td>
                                        <td>
                                            <form
                                                action="{{ route('estates.units.ownerships.destroy', ['estate' => $estate->id, 'unit' => $unit->id, 'ownership' => $owner->ownershipId]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <i id="delete-ownership-btn"
                                                    class="action-icon action-icon--delete fa fa-chain-broken fa-lg m-t-2"></i>
                                                <input class="delete-submit-btn" type="submit" hidden="">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            {{-- / owners  list  --}}
        @endisset
    </div>
@endsection
