@extends('i18n::layouts.editor.editor')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="btn-group float-right">
                <a href="{{ route('i18n.locales.create') }}" class="btn btn-success">
                    {{ __('New locale') }}
                </a>
            </div>
        </div>
    </div>

    @include('vendor.i18n.editor.locales.partials.table')
@endsection

@push('inline-scripts')
<script>
    (function () {
        const destroy_buttons = document.querySelectorAll('.locale-destroy-button');

        destroy_buttons.forEach(function (item) {
            item.onclick = function (e) {
                const source = e.target;
                result = confirm("{{ __('Are you sure want to remove the locale?') }}");

                if (result === true) {
                    source.parentNode.submit();
                }
            }
        })
    })();
</script>
@endpush