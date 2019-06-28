@extends('admin.base')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="f1 normal">Candidates</h1>
        <div class="flex justify-end items-center">

        </div>
    </div>
    <section class="card">
        <table class="w-100">
            <thead>
            <tr>
                <th class="tl col-grey f6 bold">Name</th>
                <th class="tl col-grey f6 bold">Position</th>
                <th class="tl col-grey f6 bold">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($candidates as $candidate)
                <tr>
                    <td><a href="/admin/candidates/{{ $candidate->id }}">{{ $candidate->last_name }}, {{ $candidate->first_name }}</a></td>
                    <td>{{ $candidate->position }}</td>
                    <td></td>
                </tr>
            @endforeach

            </tbody>
        </table>

    </section>
    <section>
{{--        {!! $applications->render() !!}--}}
    </section>
@endsection