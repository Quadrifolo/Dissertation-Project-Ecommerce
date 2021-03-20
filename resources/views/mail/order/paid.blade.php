@component('mail::message')


<img src="{{asset('LogoReport.png')}}"  alt=" {{config('app.name')}}" > 
 




# Invoice Paid


@guest
    'Thanks Valued Zakai Customer'

    @endguest 
 

  @lang('Thanks') , 
  
        @lang('For The Purchase')
        
       @lang('Your Order is in'). @lang('We are Working to get it Packed up') 
         @lang('and out the door soon') 

# Introduction

@lang('Here is a summary of the products you have ordered').

<table class="table">
    <thead>
        <tr>
            <th>@lang('Product name')</th>
            <th>@lang('quantity')</th>
            <th>@lang('price')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
        <tr>
            <td scope="row">{{ __("$item->name") }}</td>
            <td>{{ $item->pivot->quantity }}</td>
            <td>{{ $item->pivot->price }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@lang('Total :') {{$order->grand_total}}


@component('mail::button', ['url' => ''])
Button Text
@endcomponent

@lang('Thanks'),<br>
{{ config('app.name') }}
@endcomponent