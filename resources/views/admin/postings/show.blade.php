@extends('admin.base')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="f1 normal">{{ $posting->title }}</h1>
        <div class="flex justify-end items-center">
            <a href="/admin/postings/{{ $posting->id }}/edit"
               class="btn link flex items-center justify-center">Edit</a>
            <delete-modal item-name="{{ $posting->title }}"
                          url="/admin/postings/{{ $posting->id }}"
                          :redirect="true"></delete-modal>
        </div>
    </div>
    <section class="card mv3 flex justify-end">
        <toggle-switch label-text="Publish"
                       :toggle-state="{{ $posting->published ? 'true' : 'false'}}"
                       :unique="{{ $posting->id }}"
                       on-url="/admin/published-postings"
                       off-url="/admin/published-postings/{{ $posting->id }}"
                       :on-payload="{posting_id: {{ $posting->id }} }"
        ></toggle-switch>
    </section>
    <section class="card flex justify-between">
        <div class="w-40">
            <p class="ttu col-p f7 mb0">Title</p>
            <p class="mt1">{{ $posting->title }}</p>
            <p class="ttu col-p f7 mb0">Category</p>
            <p class="mt1">{{ $posting->category }}</p>
            <p class="ttu col-p f7 mb0">Compensation</p>
            <p class="mt1">{{ $posting->compensation }}</p>
            <p class="ttu col-p f7 mb0">Posted</p>
            <p class="mt1">{{ $posting->posted ? $posting->posted->toFormattedDateString() : 'Not Set' }}</p>
        </div>
        <div class="w-40">
            <p class="ttu col-p f7 mb0">Type</p>
            <p class="mt1">{{ $posting->type }}</p>
            <p class="ttu col-p f7 mb0">Location</p>
            <p class="mt1">{{ $posting->location }}</p>
            <p class="ttu col-p f7 mb0">Start Date</p>
            <p class="mt1">{{ $posting->start_date }}</p>
        </div>
    </section>
    <section class="card mv3">
        <p class="ttu col-p f7 mb0">Introduction</p>
        <p class="mt1">{{ $posting->introduction }}</p>
    </section>
    <section class="card mt3">

        <p class="ttu col-p f6 mb0 col-s">Job Description</p>
        <p class="mt1"> @markdown($posting->job_description) </p>
        <p class="ttu col-p f6 mb0 col-s">Responsibilities</p>
        <p class="mt1">@markdown($posting->responsibilities)</p>
        <p class="ttu col-p f6 mb0 col-s">Requirements</p>
        <p class="mt1">@markdown($posting->requirements)</p>
    </section>
    <section class="card mv3">
        <application-fields sync-url="/admin/postings/{{ $posting->id }}/application-fields"
                            :application-fields='@json($posting->applicationFields())'></application-fields>
    </section>
    <section class="card mv3">
        <p class="col-s ttu">Applications</p>
        @if($posting->applications->count() < 1)
            <p>There have been no applications for this post yet.</p>
        @else
            <table class="w-100">
                <thead>
                <tr>
                    <th class="tl col-grey f6 bold">Date</th>
                    <th class="tl col-grey f6 bold">Last Name</th>
                    <th class="tl col-grey f6 bold">First Name</th>
                    <th class="tl col-grey f6 bold">Date of Birth</th>
                    <th class="tl col-grey f6 bold">Gender</th>
                    <th class="tl col-grey f6 bold">University</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posting->applications as $application)
                    <tr>
                        <td class="lh-copy">{{ $application->created_at->toFormattedDateString() }}</td>
                        <td class="lh-copy">
                            <a class="col-s link"
                               href="/admin/applications/{{ $application->id }}">{{ $application->last_name }}</a>
                        </td>
                        <td class="lh-copy">{{ $application->first_name }}</td>
                        <td class="lh-copy">{{ $application->date_of_birth }}</td>
                        <td class="lh-copy">{{ $application->gender }}</td>
                        <td class="lh-copy">{{ $application->university }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </section>

@endsection