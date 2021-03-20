@if($locale->percentage === 100)
    @php($color = 'bg-success')
@elseif($locale->percentage > 50)
    @php($color = 'bg-warning')
@else
    @php($color = 'bg-danger')
@endif

@php($title = sprintf('%d of %d translations', count($locale->translated),
    count(\Kodilab\LaravelI18n\Models\Locale::getFallbackLocale()->translated)))

<div class="progress" title="{{ $title }}">
    <div class="progress-bar {{ $color }}" role="progressbar" style="width: {{ $locale->percentage }}%;" aria-valuenow="{{ $locale->percentage }}"
         aria-valuemin="0" aria-valuemax="100">
        {{ $locale->percentage }}% - {{ $title }}
    </div>
</div>