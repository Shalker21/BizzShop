@component('mail::message')

Poštovani {{$data['first_name'] . " " . $data['last_name']}},

Prikaz naručenih proizvoda

@component('mail::table')
| Naziv | cijena | cijena s popustom | količina |
|:-----:| ------:| -----------------:| --------:|
@foreach(unserialize(base64_decode($data['cart_data'])) as $product => $pro)
| {{$pro['name']}} | {{$pro['unit_price']}} | {{$pro['unit_special_price']}} | {{$pro['item_qty']}} |
@endforeach
@endcomponent
Ukupno: {{$data['total'] . " kn"}}
<br>
Plaćeno: {{ $data['paid'] }}
<br>
Hvala,<br>
{{ config('app.name') }}
@endcomponent