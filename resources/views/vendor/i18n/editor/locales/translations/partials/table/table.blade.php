@extends('i18n::layouts.editor.partials.table.table')

@if(!isset($id))
    @php($id = Str::random(10))
@endif

@section('table-title-' . $id)
    {{ __(':locale translations', [
        'locale' => $locale->reference
    ]) }}
@endsection

@php($action = route('i18n.locales.translations.index', compact('locale')))

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
                    <option value="translated" {{ getQueryString('status') === 'translated' ? 'selected' : '' }}>
                        {{ __('Translated') }}
                    </option>
                    <option value="untranslated" {{ getQueryString('status') === 'untranslated' ? 'selected' : '' }}>
                        {{ __('Untranslated') }}
                    </option>
                </select>
            </div>
        </div>
    </div>
@endsection

@section('table-head-' . $id)
    <tr>
        <th width="30%">Fallback Translation</th>
        <th>Translation </th>
        <th>Actions</th>
    </tr>
@endsection

@section('table-body-' . $id)
    @foreach($translations as $translation)
        <tr>
            <td>
                <textarea class="form-control">{{ $fallback_locale->translations->where('original', $translation->original)->first()->translation }}</textarea>
            </td>
            <td>
                <textarea class="form-control" name="translation">{{ $translation->translation }}</textarea>
            </td>
            <td class="table--actions">
                <form class="line-update-form"
                      action="{{ route('i18n.locales.translations.update', ['locale' => $locale]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="btn-group-sm">
                        <button type="submit" class="btn btn-success btn-sm">Save</button>
                    </div>
                    <input type="hidden" name="translation" value="">
                    <input type="hidden" name="original" value="{{$translation->original}}">
                </form>
            </td>
        </tr>
    @endforeach
@endsection

@section('table-footer-' . $id)
    {{ $translations->appends(\Illuminate\Support\Facades\Request::all())->links() }}
@endsection

