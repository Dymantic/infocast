@extends('admin.base')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="f1 normal">{{ $group }} Candidates</h1>
        <div class="flex justify-end items-center">

        </div>
    </div>
    <section class="card">
        <table class="w-100">
            <thead>
            <tr>
                <th class="tl col-grey f6 bold">Name</th>
                <th class="tl col-grey f6 bold">Position</th>
                @if($group === 'Ongoing')
                <th class="tl col-grey f6 bold">Status</th>
                <th class="tl col-grey f6 bold">Deadline</th>
                @else
                <th class="tl col-grey f6 bold">Decided By</th>
                <th class="tl col-grey f6 bold">Reason</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($candidates as $candidate)
                <tr class="pb3">
                    <td>
                        <a href="/admin/candidates/{{ $candidate->id }}"
                           class="col-p hov-s no-underline"
                        >
                            {{ $candidate->last_name . ', ' . $candidate->first_name }}
                        </a>
                    </td>
                    <td>{{ $candidate->position }}</td>
                    @if($group === 'Ongoing')
                    <td>{{ $candidate->status()['status'] }}</td>
                    <td>{{ $candidate->status()['deadline'] }}</td>
                    @else
                    <td>{{ $candidate->terminated_by }}</td>
                    <td>{{ $candidate->terminated_reason ?? 'None given' }}</td>
                    @endif
                </tr>
            @endforeach

            </tbody>
        </table>

    </section>
    <section>
        {!! $candidates->render() !!}
    </section>
@endsection