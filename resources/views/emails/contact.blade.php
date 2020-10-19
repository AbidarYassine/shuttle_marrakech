@component('mail::message')
# Contact from
## Nom: {{$details['nom']}}
## Email: {{$details['from']}}
## Telephone:{{$details['telephone']}}
## Type prestation: {{$details['prestation']}}
## Date Prestation: {{$details['date_prestation']}}
## Nombre de personnes: {{$details['nombre_persone']}}
Message:{{$details['message']}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
