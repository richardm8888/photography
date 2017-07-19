@extends('layouts.app')

@foreach ($galleries as $g)
  <a href='/gallery/{{ $g['id'] }}'>
    <img src='{{ $g['primary_photo_extras']['url_m'] }}' />
  </a>
  <br />
@endforeach
