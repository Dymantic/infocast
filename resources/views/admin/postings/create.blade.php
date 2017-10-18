@extends('admin.base')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="f1 normal">Create a new Job Posting</h1>
        <div class="flex justify-end items-center">
            <a class="btn link justify-center items-center" href="/admin/postings">Cancel</a>
        </div>
    </div>
    <posting-form url="/admin/postings" form-type="create" button-text=""></posting-form>
@endsection