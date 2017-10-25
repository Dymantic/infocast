@extends('admin.base')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="f1 normal">Inquiries</h1>
        <div class="flex justify-end items-center">

        </div>
    </div>
    <div>
        @foreach($inquiries as $inquiry)
            <div class="card mv3">
                <div class="flex justify-between">
                    <div>
                        <p class="f7 mb0 ttu col-s">Date</p>
                        <p class="mt1">{{ $inquiry->created_at->toFormattedDateString() }}</p>
                    </div>
                    <div>
                        <p class="f7 mb0 ttu col-s">Last Name</p>
                        <p class="mt1">{{ $inquiry->last_name }}</p>
                    </div>
                    <div>
                        <p class="f7 mb0 ttu col-s">First Name</p>
                        <p class="mt1">{{ $inquiry->first_name }}</p>
                    </div>
                    <div>
                        <p class="f7 mb0 ttu col-s">Email</p>
                        <p class="mt1">{{ $inquiry->email }}</p>
                    </div>
                    <div>
                        <p class="f7 mb0 ttu col-s">Phone</p>
                        <p class="mt1">{{ $inquiry->phone }}</p>
                    </div>
                </div>
                <p class="col-s ttu f7 mb0">Inquiry</p>
                <p class="mt1">{{ $inquiry->inquiry }}</p>
                <div class="flex justify-end">
                    <delete-modal url="/admin/inquiries/{{ $inquiry->id }}"
                                  :redirect="true"
                                  item-name="{{ $inquiry->first_name }}'s message"></delete-modal>
                </div>
            </div>
        @endforeach
    </div>
    <div>
        {!! $inquiries->render() !!}
    </div>
@endsection