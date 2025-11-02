@extends('shared::main-layout')
@section('title', 'الوحدات | سجل التعاقدات')
@section('active-estates', 'active')

@section('styles')
    @vite('resources/css/features/unit-contracts/index.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/unit-contracts/index.ts')
@endsection
@section('content')
    <div class="container-fluid">
        {{-- Errors --}}
        @if (isset($error) || session()->has('error'))
            <div class="row" style="display:flex; justify-content:center;">
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <div class="card card-inverse card-danger ">
                        <div class="card-block">
                            <ul>
                                @if (isset($error))
                                    <li>{{ $error }}</li>
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

        {{-- success message --}}
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
        {{-- / success message --}}

        {{-- unit information --}}
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

        @isset($unitContracts)
            {{-- unit header title --}}
            <div class="card card-inverse card-info text-xs-center">
                <div class="card-block">
                    <h3>قائمة تعاقدات الوحدة</h3>
                </div>
            </div>
            {{-- / unit header title --}}
            <div class="card-block row">
                <a href="{{ route('estates.units.contracts.create', ['estate' => $estate->id, 'unit' => $unit->id]) }}"
                    class="btn btn-md btn-primary my-5">
                    <i class="fa fa-plus-circle fa-lg d-inline-block"></i>
                    <span> تسجيل عقد ايجار </span>
                </a>


                <div class="container-fluid">
                    {{--  top pagination  --}}
                    @isset($pagination)
                        @if ($pagination->getPageCounts() > 1)
                            <ul class="pagination row">
                                <li class="page-item"><a class="page-link"
                                        href="{{ $pagination->getPreviousPageURL() }}">السابق</a>
                                </li>
                                @foreach ($pagination->getLinks() as $index => $link)
                                    <li class="page-item {{ $pagination->currentPage == $index + 1 ? 'active' : null }}"><a
                                            class="page-link " href="{{ $link }}">{{ $index + 1 }}</a>
                                    </li>
                                @endforeach
                                <li class="page-item"><a class="page-link"
                                        href="{{ $pagination->getNextPageURL() }}">التالى</a>
                                </li>
                            </ul>
                        @endif
                    @endisset($pagination)
                    {{-- / top pagination  --}}

                    <div class="row">
                        @if (count($unitContracts))
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>المستأجر</th>
                                        <th>تاريخ التعاقد</th>
                                        <th>تاريخ انتهاء التعاقد</th>
                                        <th>قيمة الايجار عند التعاقد (زيادة سنوية %)</th>
                                        <th>قيمة الايجار الحالية</th>
                                        <th>الحالة</th>
                                        <th>تحكم</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($unitContracts as $unitContract)
                                        <tr>
                                            <td>
                                                @if ($unitContract->renter)
                                                    <a style="color:black"
                                                        href="{{ route('renters.show', $unitContract->renter->id) }}"
                                                        target="_blank">
                                                        {{ $unitContract->renter->name }}</a>
                                                @else
                                                    <span style="color:red">(تم حذفة من النظام)</span>
                                                @endif
                                            </td>
                                            <td>{{ $unitContract->startDate->toDateString() }}</td>
                                            <td>{{ $unitContract->endDate->toDateString() }}</td>
                                            <td>{{ $unitContract->rentValue }}
                                                ({{ $unitContract->annualRentIncreasement }}%)
                                            </td>
                                            <td>{{ $unitContract->isExpired() || $unitContract->isInFuture() ? '----' : $unitContract->getCurrentRentValue() }}
                                            </td>
                                            <td>
                                                @if ($unitContract->isInFuture())
                                                    <span style="font-weight:bold;color:blue">لم يبدأ بعد</span>
                                                @elseif ($unitContract->isExpired())
                                                    <span style="font-weight:bold;color:red">منتهى</span>
                                                @else
                                                    <span style="font-weight:bold;color:green">سارى</span>
                                                    <div class="bars">
                                                        <progress class="progress progress-xs progress-primary m-a-0"
                                                            value="{{ $unitContract->getMonthsPassedPercentage() }}"
                                                            max="100"></progress>
                                                    </div>
                                                @endif
                                            <td>
                                                <div>
                                                    <a style="margin-left:20px;text-decoration:none"
                                                        href="{{ route('estates.units.contracts.show', ['estate' => $estate->id, 'unit' => $unit->id, 'contract' => $unitContract->id]) }}">
                                                        <i class="action-icon fa fa-eye fa-lg m-t-2 "></i>
                                                    </a>
                                                    <a style="margin-left:20px;text-decoration:none"
                                                        href="{{ route('estates.units.contracts.edit', ['estate' => $estate->id, 'unit' => $unit->id, 'contract' => $unitContract->id]) }}">
                                                        <i
                                                            class="action-icon action-icon--edit fa fa-pencil fa-lg m-t-2"></i>
                                                    </a>
                                                    <form class="d-inline"
                                                        action="{{ route('estates.units.contracts.destroy', ['estate' => $estate->id, 'unit' => $unit->id, 'contract' => $unitContract->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <i
                                                            class="delete-contract-btn action-icon action-icon--delete fa fa-trash fa-lg m-t-2"></i>
                                                        <input class="delete-submit-btn" type="submit" hidden="">
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="card card-inverse card-primary text-xs-center">
                                <div class="card-block">
                                    <blockquote class="card-blockquote">
                                        لا توجد تعاقدات ايجارية مسجلة لهذة الوحدة حتى الان - قم بتسجيل عقد ايجار
                                    </blockquote>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{--  bottom pagination  --}}
                    @isset($pagination)
                        @if ($pagination->getPageCounts() > 1)
                            <ul class="pagination row">
                                <li class="page-item"><a class="page-link"
                                        href="{{ $pagination->getPreviousPageURL() }}">السابق</a>
                                </li>
                                @foreach ($pagination->getLinks() as $index => $link)
                                    <li class="page-item {{ $pagination->currentPage == $index + 1 ? 'active' : null }}"><a
                                            class="page-link " href="{{ $link }}">{{ $index + 1 }}</a>
                                    </li>
                                @endforeach
                                <li class="page-item"><a class="page-link"
                                        href="{{ $pagination->getNextPageURL() }}">التالى</a>
                                </li>
                            </ul>
                        @endif
                    @endisset($pagination)
                    {{--  / bottom pagination  --}}
                </div>
            </div>
        @endisset
    @endsection
