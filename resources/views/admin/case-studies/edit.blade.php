@extends('admin.base', ['fullWidth' => true])

@section('content')
    <case-study-editor :study-id="{{ $study['id'] }}"></case-study-editor>
@endsection