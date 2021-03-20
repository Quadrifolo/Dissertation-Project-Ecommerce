@extends('i18n::layouts.editor.partials.table.table')

@if(!isset($id))
    @php($id = Str::random(10))
@endif

@section('table-title-' . $id)
    {{ __('Locales') }}
@endsection

@php($action = route('i18n.locales.index'))

@section('table-filters-list-' . $id)
    @if(filledQueryString('term'))
        <span class="badge badge-success">
            {{__('Term')}}:'<i>{{getQueryString('term')}}</i>'
        </span>
    @endif

    @if(filledQueryString('status'))
        <span class="badge badge-success">
            {{__('Status')}}:'<i>{{getQueryString('status')}}</i>'
        </span>
    @endif

    @if(filledQueryString('translations'))
        <span class="badge badge-success">
            {{__('Translations')}}:'<i>{{getQueryString('translations')}}</i>'
        </span>
    @endif

@endsection

@section('filters')
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-label">{{ __('Term:') }}</label>
                <input class="form-control" name="term" placeholder="Search a term" type="text"
                       value="{{ getQueryString('term', null) }}">
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-label">{{ __('Status:') }}</label>
                <select class="form-control" name="status">
                    <option value="" {{ is_null(getQueryString('status', null)) ? 'selected' : '' }}>
                        {{ __('All') }}
                    </option>
                    <option value="enabled" {{ getQueryString('status') === 'enabled' ? 'selected' : '' }}>
                        {{ __('Enabled') }}
                    </option>
                    <option value="disabled" {{ getQueryString('status') === 'disabled' ? 'selected' : '' }}>
                        {{ __('Disabled') }}
                    </option>
                </select>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-label">{{ __('Translations:') }}</label>
                <select class="form-control" name="translations">
                    <option value="" {{ is_null(getQueryString('translations', null)) ? 'selected' : '' }}>
                        {{ __('All') }}
                    </option>
                    <option value="translated" {{ getQueryString('translations') === 'translated' ? 'selected' : '' }}>
                        {{ __('Translated') }}
                    </option>
                    <option value="untranslated" {{ getQueryString('translations') === 'untranslated' ? 'selected' : '' }}>
                        {{ __('Untranslated') }}
                    </option>
                </select>
            </div>
        </div>
    </div>
@endsection

@section('table-head-' . $id)
    <tr>
        <th>ISO</th>
        <th>Region</th>
        <th>Description</th>
        <th>Fallback</th>
        <th width="30%" class="text-center">Translation progress</th>
        <th>Enabled</th>
        <th>Actions</th>
    </tr>
@endsection

@section('table-body-' . $id)
    @foreach($locales as $locale)
        <tr>
            <td>
                {{ $locale->iso }}
                @if($locale->created_by_sync)
                    <i class="fa fa-exclamation-triangle text-warning"
                       title="This locale has been created by sync with default values. Please, check it over."></i>
                @endif
            </td>
            <td>{{ $locale->region }}</td>
            <td>{{ $locale->description }}</td>
            <td>
                @if($locale->isFallback())
                    <span class="badge badge-primary">fallback</span>
                @endif
            </td>

            <td class="td--progress" style="cursor: pointer;"
                onclick="window.location.replace('{{ route('i18n.locales.translations.index', compact('locale')) }}')">

                @include('vendor.i18n.editor.locales.partials.progress_bar')

                <div class="text-center">
                    <a href="{{ route('i18n.locales.translations.index', compact('locale')) }}">{{ __('Translations') }}</a>
                </div>

            </td>

            <td class="text-center">
                @if($locale->enabled)
                    <span class="badge badge-success">
                        Enabled
                    </span>
                @else
                    <span class="badge badge-danger">
                        Disabled
                    </span>
                @endif
            </td>
            <td class="table--actions">
                <a href="{{ route('i18n.locales.show', compact('locale')) }}">See</a>
                <a href="{{ route('i18n.locales.edit', compact('locale')) }}">Edit</a>
                @unless($locale->isFallback())
                    <form action="{{ route('i18n.locales.destroy', compact('locale')) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" hidden></button>
                        <a class="locale-destroy-button" href="javascript:;">
                            {{ __('Destroy') }}
                        </a>
                    </form>
                @endunless
            </td>
        </tr>
    @endforeach
@endsection

@section('table-footer-' . $id)
    {{ $locales->appends(\Illuminate\Support\Facades\Request::all())->links() }}
@endsection