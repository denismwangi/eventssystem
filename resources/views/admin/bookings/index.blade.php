@extends('layouts.app')

@section('content')
    <h3 class="page-title">Bookings</h3>
   

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($bookings) > 0 ? 'datatable' : '' }} ">
                <thead>
                    <tr>
                        
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Event</th>
                        <th>Ticket</th>
                       
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($bookings) > 0)
                        @foreach ($bookings as $booking)
                            <tr data-entry-id="{{ $booking->id }}">
                                
                                <td>{{ $booking->name }}</td>
                                <td>{{ $booking->email }}</td>
                                <td>{{ $booking->phone }}</td>
                                @php

                                 $ticket = App\Ticket::where('id', $booking->ticket_id)->first();
                                 $tk = $ticket->title;
                                 $event = App\Event::where('id', $booking->event_id)->first();
                                 $ev = $event->title;
                                @endphp
                                <td>{{ $ev }}</td>
                                 <td>{{ $tk }}</td>

                               
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        
    </script>
@endsection