@php
    use App\Shared\Application\Utility\Month;
@endphp
@extends('shared::main-layout')
@section('title', 'الوحدات | عرض وحدة')
@section('active-estates', 'active')
@section('breadcrumbs')
    @isset($estateUtilityService)
        {{ Diglactic\Breadcrumbs\Breadcrumbs::render('estates.utility-services.show', $estate->id, $estateUtilityService->id ) }}
    @endisset
@endsection
@section('styles')
    @vite('resources/css/features/estate-utility-serviecs/show.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/estate-utility-serviecs/show.ts')
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
        @isset($estateUtilityService)
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

            {{-- top buttons --}}
            <div class="container">
                <div class="manage-btn-box">
                    <a href="{{ route('estates.utility-services.invoices.create', ['estate' => $estate->id, 'utility_service' => $estateUtilityService->id]) }}
                        "
                        class="btn btn-primary"><i class="fa fa-home fa-lg"></i>&nbsp; تسجيل فاتورة</a>
                </div>
            </div>
            {{-- / top buttons --}}

            <div class="row" style="display:flex; justify-content: center;">
                <div id="form" class="col-sm-12 col-md-10 col-lg-6">
                    <div class="card">
                        <div class="edit-box-header">
                            <strong>بيانات المرفق</strong>
                            <div>
                                <a style="margin-left:10px;text-decoration:none"
                                    href="{{ route('estates.utility-services.edit', ['estate' => $estate->id, 'utility_service' => $estateUtilityService->id]) }}">
                                    <i class="action-icon action-icon--edit fa fa-pencil fa-lg "></i>
                                </a>

                                <form class="d-inline" action="{{ route('estates.utility-services.destroy', ['estate' => $estate->id, 'utility_service' => $estateUtilityService->id]) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <i id="delete-utility-service-btn"
                                        class="action-icon action-icon--delete fa fa-trash fa-lg m-t-2"></i>
                                    <input id="delete-utility-service-submit-btn" type="submit" hidden>
                                </form>
                            </div>
                        </div>
                        <div class="card-block">
                            <ul>
                                <li>نوع المرفق : {{ $estateUtilityService->type->toLabel() }}</li>
                                <hr>
                                <li>اسم مالك العداد : {{ $estateUtilityService->ownerName }}</li>
                                <hr>
                                <li>رقم العداد : {{ $estateUtilityService->counterNumber ?? '---' }}</li>
                                <hr>
                                <li>رقم السداد الالكترونى : {{ $estateUtilityService->electronicPaymentNumber ?? '---' }}</li>
                                <hr>
                                <li>ملاحظات :
                                    <pre></pre>{{ $estateUtilityService->notes ?? '---' }}</pre>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- invoices --}}
            <hr>
            <form style="width:300px;display:flex; flex-direction:row;" method="get"
                action="{{ route('estates.utility-services.show', ['estate' => $estate->id, 'utility_service' => $estateUtilityService->id]) }}">
                <label style="width:160px;margin:auto" for="">فواتير عام </label>
                <input class="form-control" type="number" name="year" value="{{ old('year', $currentYear) }}">
                <input class="btn btn-primary" type="submit" value="عرض">
            </form>
            @if ($utilityServiceInvoices)
                <div class="container-fluid ">
                    <h5 style="text-align:center"> قائمة فواتير ال{{ $estateUtilityService->type->toLabel() }}</h5>
                    <div class="card-block">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>نوع المرفق</th>
                                    <th>تاريخ الاستحقاق</th>
                                    <th>قيمة الفاتورة</th>
                                    <th width="20%">صورة ايصال السداد</th>
                                    <th>تحكم</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($utilityServiceInvoices as $invoice)
                                    <tr>
                                        <td>{{ $estateUtilityService->type->toLabel() }}</td>
                                        <td> {{ Month::from($invoice->forMonth, true)->name . ' / ' . $invoice->forYear }} </td>
                                        <td>{{ $invoice->amount }} </td>
                                        <td>
                                            @if ($invoice->file)
                                                @php
                                                    $routeParams = [
                                                        'estate' => $estate->id,
                                                        'utility_service' => $estateUtilityService->id,
                                                        'invoice' => $invoice->id,
                                                        'file' => $invoice->file,
                                                    ];
                                                    $viewFileUrl = route( 'estates.utility-services.invoices.view-file', $routeParams,);
                                                    $downloadFileUrl = route( 'estates.utility-services.invoices.download', $routeParams,);
                                                @endphp
                                                <a href="{{ $viewFileUrl }}" target="_blank" style="margin-left:20px">
                                                    <i class="action-icon action-icon--file fa fa-file-image-o fa-lg"></i>
                                                </a>
                                                <a href="{{ $downloadFileUrl }}">
                                                    <i class="action-icon action-icon--file fa fa-download fa-lg m-t-2"></i>
                                                </a>
                                            @else
                                                ----
                                            @endif
                                        </td>
                                        <td>
                                            <div>
                                                <a style="margin-left:20px;text-decoration:none" href="{{ route('estates.utility-services.invoices.edit', ['estate' => $estate->id, 'utility_service' => $estateUtilityService->id, 'invoice' => $invoice->id]) }}">
                                                    <i class="action-icon action-icon--edit fa fa-pencil fa-lg m-t-2"></i>
                                                </a>
                                                <form class="d-inline" action="{{ route('estates.utility-services.invoices.destroy', ['estate' => $estate->id, 'utility_service' => $estateUtilityService->id, 'invoice' => $invoice->id]) }}" 
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                        <i class="delete-invoice-btn action-icon action-icon--delete fa fa-trash fa-lg m-t-2"></i>
                                                    <input class="delete-submit-btn" type="submit" hidden="">
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="container-fluid">
                    <div class="row">
                        <div class="card card-inverse card-primary text-xs-center">
                            <div class="card-block">
                                <blockquote class="card-blockquote">
                                    لا توجد فواتير مسجلة لهذا المرفق في هذا العام
                                </blockquote>
                            </div>
                        </div>
                        <p></p>
                    </div>
                </div>
            @endif

            {{-- / invoices --}}
        @endisset
    </div>
@endsection
