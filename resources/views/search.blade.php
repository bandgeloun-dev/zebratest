{{ config([
    'window.title' => trans('search.window_title'),
    'page.title' => trans('search.page_title')
]) }}

@extends('layouts/app')

@section('content')
    <div class="page-title">
        <h1>{{ config('page.title') }}</h1>
    </div>
    <div class="page-section">
        <div class="tender-search">
            <form action="{{ route('search') }}" method="GET">
                <div class="row mb-3">
                    <label for="tender-name"
                           class="col-md-4 col-form-label text-md-end">{{ trans('search.form_field_name') }}</label>
                    <div class="col-md-6">
                        <input name="tender-name" type="text" id="tender-name"
                               class="form-control @error('tender-name') is-invalid @enderror"
                               value="{{ old('search_tender-name') }}">
                        @error('tender-name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="date"
                           class="col-md-4 col-form-label text-md-end">{{ trans('search.form_field_date') }}</label>
                    <div class="col-md-6">
                        <input name="date" type="date" id="date"
                               class="form-control @error('date') is-invalid @enderror"
                               value="{{ old('search_date') }}">
                        @error('date')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-md-2 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ trans('search.form_submit_button') }}
                        </button>
                    </div>
                    @if (!empty($data))
                        <div class="col-md-1 offset-md-3">
                            <a href="{{ route('json_file', request()->all()) }}" class="btn btn-primary">
                                {{ trans('search.form_download_button') }}
                            </a>
                        </div>
                    @endif
                </div>
            </form>
        </div>
        @if (!empty($data))
            <table class="tender-list">
                <thead>
                    <tr>
                        <th>{{ trans('search.table_column_xml') }}</th>
                        <th>{{ trans('search.table_column_id') }}</th>
                        <th>{{ trans('search.table_column_status') }}</th>
                        <th>{{ trans('search.table_column_name') }}</th>
                        <th>{{ trans('search.table_column_date') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{ $item->xml_id }}</td>
                            <td>{{ $item->number }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->date_update }}</td>
                            <td>
                                <a href="{{ route('json_file', ['id' => $item->id]) }}">
                                    {{ trans('search.form_download_button') }}
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif(isset($error))
            <div class="search-info alert alert-danger">
                {{ $error }}
            </div>
        @endif
    </div>
@endsection
