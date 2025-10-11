@php
    use App\Shared\Domain\Enum\Unit\UnitIsEmpty;
@endphp
@extends('shared::main-layout')
@section('title', 'مستندات العقار | عرض مستند')
@section('active-estates', 'active')
@section('styles')
    @vite('resources/css/features/estate-documents/show.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/estate-documents/show.ts')
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

        @isset($estateDocument)
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
                    <a href="{{ route('estates.documents.index', $estate->id) }}" type="button" class="btn btn-primary">
                        <i class="fa fa-list fa-lg "></i> &nbsp; الذهاب لقائمة مستندات العقار</a>
                </div>
            </div>
            {{-- / estaet information  --}}

            <div class="row" style="display:flex; justify-content: center;">
                <div id="form" class="col-sm-12 col-md-10 col-lg-6">
                    <div class="card">
                        <div class="edit-box-header">
                            <strong>بيانات المستند</strong>
                            <div>
                                <a style="margin-left:10px;text-decoration:none"
                                    href="{{ route('estates.documents.edit', ['estate' => $estate->id, 'document' => $estateDocument->id]) }}">
                                    <i class="action-icon action-icon--edit fa fa-pencil fa-lg "></i>
                                </a>
                                <form class="d-inline"
                                    action="{{ route('estates.documents.destroy', ['estate'=>$estate->id , 'document'=> $estateDocument->id]) }}"
                                    method="post">
                                    @method('DELETE')
                                    @csrf
                                    <i id="delete-estate-document-btn"
                                        class="action-icon action-icon--delete fa fa-trash fa-lg m-t-2"></i>
                                    <input id="delete-submit-btn" type="submit" hidden>
                                </form>
                            </div>
                        </div>
                        <div class="card-block"  metho="post" action="{{ route('estates.documents.update', ['estate' => $estate->id , 'document', $estateDocument->id]) }}" enctype="multipart/form-data" >
                            <ul>
                                <li>عنوان المستند : {{ $estateDocument->title }}</li><hr>
                                <li>وصف المستند : {{ $estateDocument->description }}</li><hr>
                            </ul>
                            {{-- buttons --}}
                            <div class="form-group" style="margin-top: 40px">
                                {{-- view file --}}
                                <a href="{{ route('estates.documents.view-file', ['estate' => $estate->id, 'file' => $estateDocument->file]) }}"
                                    target="_blank" class="btn btn-md btn-primary">
                                    <i class="fa fa-eye "></i>
                                    عرض المستند</a>
                                {{-- / view file --}}

                                {{-- download file --}}
                                <a href="{{ route('estates.documents.download', ['estate' => $estate->id, 'file' => $estateDocument->file]) }}"
                                    class="btn btn-md btn-primary">

                                    <i class="fa fa-download "></i>
                                    تحميل المستند</a>
                                {{-- / download file --}}
                            </div>
                            {{-- / buttons --}}
                        </div>
                    </div>
                </div>

            </div>
        @endisset
    </div>
@endsection
