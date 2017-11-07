@extends('admin.base')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="f1 normal">Application for {{ $application->posting ? $application->posting->title : '[POST DELETED]' }}</h1>
        <div class="flex justify-end items-center">

        </div>
    </div>
    <div class="card mv3">
        <p><span class="col-s">Application Date: </span>{{ $application->created_at->toFormattedDateString() }}</p>
    </div>
    @if($application->posting)
    <section class="card">
        <p class="col-s ttu">Job Details</p>
        <div class="flex justify-between">
            <div class="w-40">
                <p class="ttu col-p f7 mb0">Title</p>
                <p class="mt1">{{ $application->posting->title }}</p>
                <p class="ttu col-p f7 mb0">Category</p>
                <p class="mt1">{{ $application->posting->category }}</p>
                <p class="ttu col-p f7 mb0">Compensation</p>
                <p class="mt1">{{ $application->posting->compensation }}</p>
                <p class="ttu col-p f7 mb0">Posted</p>
                <p class="mt1">{{ $application->posting->posted ? $application->posting->posted->toFormattedDateString() : 'Not Set' }}</p>
            </div>
            <div class="w-40">
                <p class="ttu col-p f7 mb0">Type</p>
                <p class="mt1">{{ $application->posting->type }}</p>
                <p class="ttu col-p f7 mb0">Location</p>
                <p class="mt1">{{ $application->posting->location }}</p>
                <p class="ttu col-p f7 mb0">Start Date</p>
                <p class="mt1">{{ $application->posting->start_date }}</p>
            </div>
        </div>
    </section>
    @else
        <section class="card mv3">
            <p>The original posting for this application has since been deleted.</p>
        </section>
    @endif

    <section class="card mv3">
        <p class="col-s ttu">Personal Details</p>
        <div class="flex justify-between">
            <div class="w-40">
                <p class="ttu col-p f7 mb0">Last Name</p>
                <p class="mt1">{{ $application->last_name }}</p>
                <p class="ttu col-p f7 mb0">First Name</p>
                <p class="mt1">{{ $application->first_name }}</p>
                <p class="ttu col-p f7 mb0">Gender</p>
                <p class="mt1">{{ $application->gender }}</p>
                <p class="ttu col-p f7 mb0">Date of Birth</p>
                <p class="mt1">{{ $application->date_of_birth }}</p>
            </div>
            <div class="w-40">
                <p class="ttu col-p f7 mb0">Email</p>
                <p class="mt1">{{ $application->email }}</p>
                <p class="ttu col-p f7 mb0">Phone</p>
                <p class="mt1">{{ $application->phone }}</p>
                <p class="ttu col-p f7 mb0">Preferred Contact Method</p>
                <p class="mt1">{{ $application->contact_method }}</p>
                <p class="ttu col-p f7 mb0">English Ability</p>
                <p class="mt1">{{ $application->english_ability }}</p>
                <p class="ttu col-p f7 mb0">Mandarin Ability</p>
                <p class="mt1">{{ $application->mandarin_ability }}</p>
            </div>
        </div>
    </section>
    <section class="card mv3">
        <p class="col-s ttu">Application/Qualification Details</p>
        <p class="ttu col-p f7 mb0">University/College</p>
        <p class="mt1">{{ $application->university }}</p>
        <p class="ttu col-p f7 mb0">Prev/Current Company</p>
        <p class="mt1">{{ $application->prev_company }}</p>
        <p class="ttu col-p f7 mb0">Prev/Current Position</p>
        <p class="mt1">{{ $application->prev_position }}</p>
        <p class="ttu col-p f7 mb0">Qualifications</p>
        <p class="mt1">{{ $application->qualifications }}</p>
        <p class="ttu col-p f7 mb0">Skills to Highlight</p>
        <p class="mt1">{{ $application->skills }}</p>
        <p class="ttu col-p f7 mb0">Additional Notes or Message</p>
        <p class="mt1">{{ $application->notes }}</p>
    </section>
    <section class="card mv3">
        <p class="col-s ttu">Attachments</p>
        <div class="flex justify-around">
            @if($application->avatarUrl())
                <div>
                    <p>Avatar</p>
                    <a href="{{ $application->avatarUrl() }}"
                       download>
                        <img src="{{ $application->avatarUrl() }}"
                             width="200px"
                             alt="">
                    </a>
                </div>
            @endif
            @if($application->coverLetterUrl())
                <div>
                    <p>Cover letter</p>
                    <a href="{{ $application->coverLetterUrl() }}"
                       download>
                        <img src="/images/default_doc.svg"
                             width="130px"
                             alt="">
                    </a>
                </div>
            @endif
            @if($application->resumeUrl())
                <div>
                    <p>CV</p>
                    <a href="{{ $application->resumeUrl() }}"
                       download>
                        <img src="/images/default_doc.svg"
                             width="130px"
                             alt="">
                    </a>
                </div>
            @endif
        </div>

    </section>
@endsection