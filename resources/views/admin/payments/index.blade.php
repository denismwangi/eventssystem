@extends('layouts.app')

@section('content')
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($payments) > 0 ? 'datatable' : '' }} ">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>@lang('quickadmin.payments.fields.email')</th>
                        <th>event</th>
                        <th>@lang('quickadmin.payments.fields.amount')</th>
                        <th>Status</th>
                        <th>Actions</th>
                        
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($payments) > 0)
                        @foreach ($payments as $payment)
                            <tr data-entry-id="{{ $payment->id }}">
                                  <td>{{ $payment->name }}</td>
                                    <td>{{ $payment->phone }}</td>
                                
                                <td>{{ $payment->email }}</td>
                                @php

                                $event = App\Event::where('id', $payment->event_id)->first();

                                @endphp
                                <td>{{ $event->title }}</td>
                                <td>{{ $payment->amount }}</td>
                                <td>
                                    @if($payment->status == 0)
                                    <button class="btn btn-xs btn-warning js-delete-selected">
                                        Payment Awaiting Confirmation
                                    </button>
                                    @elseif($payment->status == 1)
                                    <button class="btn btn-xs btn-success js-delete-selected">
                                        Payment Confirmed
                                    </button>
                                    @endif
                                    </td>
                                <td>
                                    @can('payment_view')
                                    <a href="{{ route('admin.payments.show',[$payment->id]) }}" class="btn btn-primary">@lang('quickadmin.qa_view')</a>
                                   
                                    @endcan
                                     @can('event_create')
                                      <a href="{{ url('admin/payment/update',$payment->id) }}" onclick="return confirm('are you sure?')" class="btn btn-success">Confirm Payment</a>

                                     @endcan
</td>
                            </tr>
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