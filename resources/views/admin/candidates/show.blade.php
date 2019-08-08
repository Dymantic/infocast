@extends('admin.base')

@section('content')
    <candidate-tracking-page :candidate='@json($candidate)'></candidate-tracking-page>
@endsection