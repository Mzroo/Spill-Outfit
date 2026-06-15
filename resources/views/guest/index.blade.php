@extends('layouts.guest')

@section('content')
@include('guest.partials.navbar')
@include('guest.partials.hero')
@include('guest.partials.kategori')
@include('guest.partials.produk')
{{-- @include('guest.partials.airekomendasi') --}}
@include('guest.partials.community')
@include('guest.partials.whyspiilsOutfit')
@include('guest.partials.cta')
@include('guest.partials.footer')

@endsection