@extends('i18n::layouts.editor.editor')

@section('content')
    <div class="alert alert-warning text-center">
        Please, keep the coherence with the "<b>:</b>" and <b>HTML tags "<>"</b> in your translations. Any change with those elements
        could make show your translations incorrectly.
    </div>
    @include('vendor.i18n.editor.locales.translations.partials.table.table')
@endsection


@push('inline-scripts')
    <script>

        /**
         * Update a row with the data fetched
         * @param tr
         * @param line
         */
        function updateRowFromFetchData(tr, line)
        {
            getTranslationTextArea(tr).value = line;
        }


        /**
         * Returns the translation textarea from a row
         * @param tr
         */
        function getTranslationTextArea(tr)
        {
            return tr.querySelectorAll('textarea[name="translation"]:not([disabled]')[0];
        }


        /**
         * Show a green color effect as a feedback
         * @param tr
         */
        function renderStatusEffect(tr, status)
        {
            item_class = 'table-' + status;
            tr.classList.add(item_class);
            setTimeout(() => {
                tr.classList.remove(item_class);
            }, 1000);
        }


        /**
         * Update the progress bar from the index view
         * @param html
         */
        function updateProgressBar(html) {
            document.querySelector('#translation_progress').innerHTML = html;
        }


        const forms = document.querySelectorAll('form.line-update-form');

        console.log(forms);

        forms.forEach((form) => {
            form.addEventListener('submit', (e) => {

                e.preventDefault();

                e.stopPropagation();

                form = e.target;
                tr = form.parentElement.parentElement;

                form.querySelector('input[name="translation"]').value = getTranslationTextArea(tr).value;


                const url = form.getAttribute('action');
                const method = 'POST';
                const data = new FormData(form);

                fetch(url, {
                    method: method,
                    body: data

                }).then(response => {
                    return response.json();
                }).then((response, data) => {
                    updateRowFromFetchData(tr, response.line);
                    renderStatusEffect(tr, 'success');
                    //updateProgressBar(response.progress_bar_html);
                    console.log("Translation saved!");

                }).catch(error => {
                    console.error("Error when trying to save a translation!");
                    renderStatusEffect(tr, 'danger');
                });
            });
        });

    </script>
@endpush