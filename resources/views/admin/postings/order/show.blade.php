@extends('admin.base')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="f1 normal">Order of Job Postings</h1>
        <div class="flex justify-end items-center">
            <a class="btn link justify-center items-center" href="/admin/postings">Back to Postings</a>
        </div>
    </div>
    <sortable-list :items="{{ json_encode($postings) }}" url="/admin/postings-order"></sortable-list>
@endsection