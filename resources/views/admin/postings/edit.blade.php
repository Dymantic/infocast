@extends('admin.base')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="f1 normal">Edit this posting</h1>
        <div class="flex justify-end items-center">
            <a href="/admin/postings/{{ $posting->id }}"
               class="btn link flex items-center justify-center">Cancel</a>
        </div>

    </div>
    <posting-form url="/admin/postings/{{ $posting->id }}"
                  form-type="update"
                  button-text=""
                  :form-attributes='@json($posting->toJsonableArray())'
    ></posting-form>
@endsection