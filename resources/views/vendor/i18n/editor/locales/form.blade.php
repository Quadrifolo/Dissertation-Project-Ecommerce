@extends('i18n::layouts.editor.editor')

@section('content')
    @if($locale->exists)
        @php($route = route('i18n.locales.update', compact('locale')))
    @else
        @php($route = route('i18n.locales.store'))
    @endif
    <form action="{{ $route }}" method="POST">

        @csrf

        @if($locale->exists)
            <input type="hidden" name="_method" value="PATCH">
        @endif

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">

                                <div class="form-group">
                                    <label for="input_iso">
                                        ISO 639-1
                                        <small class="text-muted">e.g 'en'</small>
                                    </label>
                                    <input id="input_iso" name="iso" type="text"
                                           class="form-control {{ $errors->has('iso') ? 'is-invalid' : '' }}"
                                           value="{{ old('iso', $locale->iso) }}">
                                    @if($errors->has('iso'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('iso') }}
                                        </div>
                                    @endif
                                </div>

                            </div>
                            <div class="col-md-2">

                                <div class="form-group">
                                    <label for="input_region">
                                        Region
                                        <small class="text-muted">e.g 'GB, ES, FR ...'</small>
                                    </label>
                                    <input id="input_region" name="region" type="text"
                                           class="form-control {{ $errors->has('region') ? 'is-invalid' : '' }}"
                                           value="{{ old('region', $locale->region) }}">
                                    @if($errors->has('region'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('region') }}
                                        </div>
                                    @endif
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="input_description">
                                        Short Description
                                        <small class="text-muted">e.g 'English from US'</small>
                                    </label>
                                    <input id="input_description" name="description" type="text"
                                           class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                           value="{{ old('description', $locale->description) }}">
                                    @if($errors->has('description'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('description') }}
                                        </div>
                                    @endif
                                </div>

                            </div>
                            <div class="col-md-2">

                                <div class="form-group">
                                    <label for="input_enabled">
                                        {{ __('Status') }}
                                    </label>
                                    <select id="input_enabled" name="enabled" class="form-control"
                                        @if($locale->isFallback())
                                            title="{{ __('Locale status can not be changed because this is the fallback locale.')}}"
                                        @endif
                                        {{ $locale->isFallback() ? 'disabled' : '' }}>

                                        <option value="1"
                                            {{ old('enabled', $locale->enabled) === true ? 'selected' : '' }}>
                                            {{ __('Enabled') }}
                                        </option>

                                        @unless($locale->isFallback())
                                            <option value="0"
                                                {{ old('enabled', $locale->enabled) === false ? 'selected' : '' }}>
                                                {{ __('Disabled') }}
                                            </option>
                                        @endunless

                                     </select>
                                    @if($errors->has('enabled'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('enabled') }}
                                        </div>
                                    @endif
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-header">Date & Time Locale Settings</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="input_carbon_locale">
                                        Date & Time Locale
                                        <small class="text-muted">
                                            usually same as ISO 639-1. If you leave it blank, ISO 639-1 is used.
                                        </small>
                                    </label>
                                    <input id="input_carbon_locale" name="carbon_locale" type="text"
                                           class="form-control {{ $errors->has('carbon_locale') ? 'is-invalid' : '' }}"
                                           value="{{ old('carbon_locale', $locale->carbon_locale) }}">
                                    @if($errors->has('carbon_locale'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('carbon_locale') }}
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="input_tz">
                                        Time zone
                                    </label>

                                    <select id="input_tz" name="tz" class="form-control">

                                        <option value=""
                                                {{ old('tz', $locale->tz) === null ? 'selected' : '' }}>
                                            {{ __('Default') }}
                                        </option>

                                        @foreach(DateTimeZone::listIdentifiers() as $timezone)
                                            <option value="{{ $timezone }}"
                                                    {{ old('tz', $locale->tz) === $timezone ? 'selected' : '' }}>
                                                {{ $timezone }}
                                            </option>
                                        @endforeach

                                    </select>

                                    @if($errors->has('tz'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('tz') }}
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-header">Laravel locale</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="input_laravel_locale">
                                        Laravel Locale
                                        <small class="text-muted">
                                            usually same as ISO 639-1. If you leave it blank, ISO 639-1 is used.
                                        </small>
                                    </label>
                                    <input id="input_laravel_locale" name="laravel_locale" type="text"
                                           class="form-control {{ $errors->has('laravel_locale') ? 'is-invalid' : '' }}"
                                           value="{{ old('laravel_locale', $locale->carbon_locale) }}">
                                    @if($errors->has('laravel_locale'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('laravel_locale') }}
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-header">Currency Locale Settings</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">This is how you would see the currency value of one thousand on your website</div>
                                <div id="currency_status" class="text-center h3">00.00€</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">

                                <div class="form-group">
                                    <label for="input_currency_number_decimals">
                                        Number of decimals
                                    </label>
                                    <input type="text" id="input_currency_number_decimals" name="currency_number_decimals"
                                           class="change-status form-control {{ $errors->has('currency_number_decimals') ? 'is-invalid' : '' }}"
                                           value="{{ old('currency_number_decimals', $locale->currency_number_decimals) }}">
                                    @if($errors->has('currency_number_decimals'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('currency_number_decimals') }}
                                        </div>
                                    @endif
                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">
                                    <label for="input_currency_decimals_punctuation">
                                        Decimal punctuation
                                    </label>
                                    <input type="text" id="input_currency_decimals_punctuation" name="currency_decimals_punctuation"
                                           class="change-status form-control {{ $errors->has('currency_decimals_punctuation') ? 'is-invalid' : '' }}"
                                           value="{{ old('currency_decimals_punctuation', $locale->currency_decimals_punctuation) }}">
                                    @if($errors->has('currency_decimals_punctuation'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('currency_decimals_punctuation') }}
                                        </div>
                                    @endif
                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">
                                    <label for="input_currency_thousands_separator">
                                        Thousands separator
                                    </label>
                                    <input type="text" id="input_currency_thousands_separator" name="currency_thousands_separator"
                                           class="change-status form-control {{ $errors->has('currency_thousands_separator') ? 'is-invalid' : '' }}"
                                           value="{{ old('currency_thousands_separator', $locale->currency_thousands_separator) }}">
                                    @if($errors->has('currency_thousands_separator'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('currency_thousands_separator') }}
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="input_currency_symbol">
                                        Currency symbol
                                    </label>
                                    <input type="text" id="input_currency_symbol" name="currency_symbol"
                                           class="change-status form-control {{ $errors->has('currency_symbol') ? 'is-invalid' : '' }}"
                                           value="{{ old('currency_symbol', $locale->currency_symbol) }}">
                                    @if($errors->has('currency_symbol'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('currency_symbol') }}
                                        </div>
                                    @endif
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="input_currency_symbol_position">
                                        Symbol position
                                    </label>
                                    <select name="currency_symbol_position" id="input_currency_symbol_position"
                                            class="change-status form-control {{ $errors->has('currency_symbol_position') ? 'is-invalid' : '' }}">

                                        <option value="before" {{ old('currency_symbol_position', $locale->currency_symbol_position) === 'before' ? 'selected' : '' }}>
                                            Before
                                        </option>
                                        <option value="after" {{ old('currency_symbol_position', $locale->currency_symbol_position) === 'after' ? 'selected' : '' }}>
                                            After
                                        </option>

                                    </select>
                                    @if($errors->has('currency_decimals_punctuation'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('currency_decimals_punctuation') }}
                                        </div>
                                    @endif
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">

            <div class="col-md-12">
                <div class="d-flex">

                    <a href="{{ URL::previous() }}" class="btn btn-danger">{{ __('Cancel') }}</a>

                    @if($locale->exists)
                        <button type="submit" class="btn btn-success ml-auto">{{ __('Update locale') }}</button>
                    @else
                        <button type="submit" class="btn btn-success ml-auto">{{ __('Create locale') }}</button>
                    @endif

                </div>
            </div>
        </div>
    </form>
@endsection

@push('inline-scripts')
    <script>
        function number_format (number, decimals, dec_point, thousands_sep) {
            // Strip all characters but numerical ones.
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function (n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        function update_currency_status()
        {
            decimals = document.querySelector('#input_currency_number_decimals').value;
            dec_point = document.querySelector('#input_currency_decimals_punctuation').value;
            thousands_sep = document.querySelector('#input_currency_thousands_separator').value;
            currency_symbol = document.querySelector('#input_currency_symbol').value;
            symbol_position = document.querySelector('#input_currency_symbol_position').value;

            currency_status = document.querySelector('#currency_status');

            value = number_format(1000, decimals, dec_point, thousands_sep);
            result = "";

            if (symbol_position === 'before')
            {
                result += currency_symbol + ' ';
            }

            result += value;

            if (symbol_position === 'after')
            {
                result += ' ' + currency_symbol;
            }

            currency_status.innerHTML = result;
        }

        status_changers = document.querySelectorAll('.change-status');

        status_changers.forEach((item) => {
            item.addEventListener('change', () => {
                update_currency_status();
            });
        });

        update_currency_status();
    </script>
@endpush