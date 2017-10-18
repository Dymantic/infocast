@extends('admin.base')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="f1 normal">Applications</h1>
        <div class="flex justify-end items-center">

        </div>
    </div>
    <section class="card">
        <table class="w-100">
            <thead>
            <tr>
                <th class="tl col-grey f6 bold">Date</th>
                <th class="tl col-grey f6 bold">Name</th>
                <th class="tl col-grey f6 bold">Job Posting</th>
                <th class="tl col-grey f6 bold">Date of Birth</th>
                <th class="tl col-grey f6 bold">Gender</th>
            </tr>
            </thead>
            <tbody>
            @foreach($applications as $application)
                <tr>
                    <td class="lh-copy">{{ $application->created_at->toFormattedDateString() }}</td>
                    <td class="lh-copy">
                        <a class="col-s link"
                           href="/admin/applications/{{ $application->id }}">{{ $application->last_name . ', ' . $application->first_name }}</a>
                    </td>
                    <td class="lh-copy">{{ $application->posting->title }}</td>
                    <td class="lh-copy">{{ $application->date_of_birth }}</td>
                    <td class="lh-copy">{{ $application->gender }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection