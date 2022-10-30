{{ config([
    'window.title' => trans('newtender.window_title'),
    'page.title' => trans('newtender.page_title')
]) }}

@extends('layouts/app')

@section('content')
    <div class="page-title">
        <h1>{{ config('page.title') }}</h1>
    </div>
    @include('inc.messages')
    <div class="page-section">
        <div class="tender-add">
            <form action="{{ route('add') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="xml_id"
                           class="col-md-4 col-form-label text-md-end">{{ trans('newtender.form_field_xml_id') }}</label>
                    <div class="col-md-6">
                        <input name="xml_id" type="text" id="xml_id"
                               class="form-control @error('xml_id') is-invalid @enderror"
                               value="{{ old('xml_id') }}">
                        @error('xml_id')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="number"
                           class="col-md-4 col-form-label text-md-end">{{ trans('newtender.form_field_number') }}</label>
                    <div class="col-md-6">
                        <input name="number" type="text" id="number"
                               class="form-control @error('number') is-invalid @enderror"
                               value="{{ old('number') }}">
                        @error('number')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="status"
                           class="col-md-4 col-form-label text-md-end">{{ trans('newtender.form_field_status') }}</label>
                    <div class="col-md-6">
                        <input name="status" type="text" id="status"
                               class="form-control @error('status') is-invalid @enderror"
                               value="{{ old('status') }}">
                        @error('status')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tender-name"
                           class="col-md-4 col-form-label text-md-end">{{ trans('newtender.form_field_name') }}</label>
                    <div class="col-md-6">
                        <input name="tender-name" type="text" id="tender-name"
                               class="form-control @error('tender-name') is-invalid @enderror"
                               value="{{ old('tender-name') }}">
                        @error('tender-name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="date_update"
                           class="col-md-4 col-form-label text-md-end">{{ trans('newtender.form_field_date') }}</label>
                    <div class="col-md-6">
                        <input name="date_update" type="datetime-local" id="date_update"
                               class="form-control @error('date_update') is-invalid @enderror"
                               value="{{ old('date_update') }}">
                        @error('date_update')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ trans('newtender.form_submit_button') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
