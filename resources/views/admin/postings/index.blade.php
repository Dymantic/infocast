@extends('admin.base')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="f1 normal">Job Postings</h1>
        <div class="flex justify-end items-center">
            <a class="btn link justify-center items-center" href="/admin/postings/create">New Posting</a>
        </div>
    </div>
    <section class="card">
        <table class="w-100">
            <thead>
            <tr>
                <th class="tl col-grey f6 bold">#</th>
                <th class="tl col-grey f6 bold">Title</th>
                <th class="tl col-grey f6 bold">Type</th>
                <th class="tl col-grey f6 bold">Posted</th>
                <th class="tl col-grey f6 bold">Applications</th>
                <th class="tl col-grey f6 bold">Published</th>
            </tr>
            </thead>
            <tbody>
            @foreach($postings as $posting)
                <tr>
                    <td class="lh-copy">{{ $posting->id }}</td>
                    <td class="lh-copy">
                        <a class="col-s link" href="/admin/postings/{{ $posting->id }}">{{ $posting->title }}</a>
                    </td>
                    <td class="lh-copy">{{ $posting->type }}</td>
                    <td class="lh-copy">{{ $posting->posted ? $posting->posted->toFormattedDateString() : 'Not Set' }}</td>
                    <td class="lh-copy">{{ $posting->applications_count }}</td>
                    <td class="lh-copy">{{ $posting->published ? 'Yes' : 'No' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </section>
@endsection