<meta charset="UTF-8">
<META HTTP-EQUIV="Content-type" CONTENT="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta http-equiv="X-UA-Compatible" content="ie=edge">
@if(App::environment('local'))
    <link rel="preload" as="style" rel="stylesheet" href="{{mix('css/estilos.css')}}" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{mix('css/estilos.css')}}"></noscript>
@else
    <link rel="preload" as="style" rel="stylesheet" href="{{mix('css/estilos.css')}}" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{mix('css/estilos.css')}}"></noscript>
@endif