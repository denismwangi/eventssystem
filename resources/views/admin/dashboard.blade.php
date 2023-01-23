@extends('layouts.app')

@section('content')

 @php
$events= App\Event::orderBy('created_at',  'DESC')->get();
$tickets=App\Ticket::orderBy('id','DESC')->get(); 
$users = App\User::orderBy('id','DESC')->get(); 
$bookings = App\Booking::orderBy('id', 'DESC')->get();
@endphp
  <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <style type="text/css">
                .bg-info{
                    background-color: #17a2b8!important;
                }
                .bg-success{
                    background-color: #dc3545!important;
                }
                .bg-warning{
                    background-color: #28a745!important;

                }
                .bg-danger{
                    background-color: #ffc107!important;

                }
            </style>
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{count($tickets)}}</h3>

                <p>All Tickets</p>
              </div>
              <div class="icon">
               <i class="fa fa-tags" aria-hidden="true"></i>

              </div>
              <a href="/admin/tickets" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{count($events)}}</h3>

                <p>Events</p>
              </div>
              <div class="icon">
<i class="fa fa-tasks" aria-hidden="true"></i>

              </div>
              <a href="/admin/events" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{count($bookings)}}</h3>

                 <p>Bookings</p>              </div>
              <div class="icon">
<i class="fa fa-calendar-check-o" aria-hidden="true"></i>
            </div>
              <a href="/admin/bookings" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{count($users)}}</h3>

                <p>Registered Users</p>
              </div>
              <div class="icon">
               <i class="ion ion-person-add"></i>
              </div>
              <a href="/admin/users" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <h3 class="page-title">Recently Created Events</h3>
    @can('event_create')
    <p>
        <a href="{{ route('admin.events.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($events) > 0 ? 'datatable' : '' }} @can('event_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('event_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.events.fields.title')</th>
                        <th>@lang('quickadmin.events.fields.description')</th>
                        <th>@lang('quickadmin.events.fields.start-time')</th>
                        <th>@lang('quickadmin.events.fields.venue')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>

                    @if (count($events) > 0)
                        @foreach ($events as $event)
                            <tr data-entry-id="{{ $event->id }}">
                                @can('event_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $event->title }}</td>
                                <td>{!! $event->description !!}</td>
                                <td>{{ $event->start_time }}</td>
                                <td>{!! $event->venue !!}</td>
                                <td>
                                    @can('event_view')
                                    <a href="{{ route('admin.events.show',[$event->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('event_edit')
                                    <a href="{{ route('admin.events.edit',[$event->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('event_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.events.destroy', $event->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('event_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.events.mass_destroy') }}';
        @endcan

    </script>
    </div>
</section>

@endsection
