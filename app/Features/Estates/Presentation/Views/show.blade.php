@extends('shared::main-layout')
@section('title', 'العقارات | عرض عقار')
@section('active-estates', 'active')
@section('styles')
    @vite('resources/css/features/estates/show.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/estates/show.ts')
@endsection

@section('content')
    <div class="container-fluid ">
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

        {{-- Manage Estate --}}
        @if (isset($estate))
            <div class=" container">
                <div class="manage-btn-box">
                    <a href="{{ route('estates.units.index',  $estate->id)  }}"
                        class="btn btn-primary"><i class="fa fa-home fa-lg"></i>&nbsp; وحدات</a>
                    <a href="{{ route('estates.documents.index' , $estate->id)}}" class="btn btn-primary"> <i class="icon-docs icons fa-lg"></i>&nbsp; مستندات</a>
                    <a href="{{ route('estates.utility-services.index', $estate->id)}}" class="btn btn-primary"><i class="fa fa-bolt fa-lg "></i>&nbsp; مرافق</a>
                </div>
            </div>
        @endif
        {{-- / Manage Estate --}}

        @isset($estate)
            <div class="row" style="display:flex; justify-content: center;">
                <div id="form" class="col-sm-12 col-md-10 col-lg-6">
                    <div class="card">
                        <div class="edit-box-header">
                            <strong>بيانات العقار</strong>
                            <div>
                                <a style="margin-left:10px;text-decoration:none"
                                    href="{{ route('estates.edit', $estate->id) }}">
                                    <i class="action-icon action-icon--edit fa fa-pencil fa-lg "></i>
                                </a>
                                <form class="d-inline" action="{{ route('estates.destroy', $estate->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <i id="delete-estate-btn"
                                        class="action-icon action-icon--delete fa fa-trash fa-lg m-t-2"></i>
                                    <input id="delete-estate-submit-btn" type="submit" hidden>
                                </form>
                            </div>
                        </div>

                        <form class="card-block">
                            @csrf
                            {{-- name --}}
                            <div class="form-group">
                                <label for="name">الاسم <span class="required">*</span></label>
                                <input name="name" type="text" class="form-control" id="name"
                                    placeholder="اسم رمزى للعقار" value="{{ $estate->name }}" readonly>
                            </div>
                            {{-- / name --}}

                            {{-- address --}}
                            <div class="form-group">
                                <label for="address">العنوان <span class="required">*</span></label>
                                <textarea name="address" class="form-control" id="address" placeholder="وصف دقيق للعنوان" readonly>{{ $estate->address }}</textarea>
                            </div>
                            {{-- / address --}}

                            {{-- floor counts --}}
                            <div class="form-group">
                                <label for="floor_count">عدد الطوابق <span class="required">*</span></label>
                                <input name="floor_count" type="text" class="form-control" id="floor_count" readonly
                                    placeholder="عدد الطوابق مع الطابق الارضى" value={{ $estate->floorCount }}>
                            </div>
                            {{-- / floor counts --}}

                            {{-- residential unit count --}}
                            <div class="form-group">
                                <label for="residential_unit_count">عدد الوحدات السكنية</label>
                                <input name="residential_unit_count" type="text" class="form-control"
                                    id="residential_unit_count" readonly placeholder="عدد الوحدات السكنية"
                                    value={{ $estate->residentialUnitCount }}>
                            </div>
                            {{-- / residential unit count --}}

                            {{-- commercial unit count --}}
                            <div class="form-group">
                                <label for="commercial_unit_count">عدد الوحدات التجارية</label>
                                <input name="commercial_unit_count" type="text" class="form-control"
                                    id="commercial_unit_count" readonly placeholder="عدد الوحدات التجارية"
                                    value={{ $estate->commercialUnitCount }}>
                            </div>
                            {{-- / commercial unit count --}}

                        </form>
                    </div>
                </div>
            </div>
        @endisset
</div>
@endsection
