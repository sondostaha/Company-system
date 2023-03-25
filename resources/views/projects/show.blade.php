@extends('layouts.master')
@section('css')

@section('title')
   show Project 
@stop

<!-- Internal Data table css -->

<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            {{-- <h4 class="content-title mb-0 my-auto">employee</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{$employee->id}} --}}
                </span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- row opened -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
               
            <div class="card-body">
           
                <a href="{{route('employees')}}">Back</a>
                <div class="table-responsive hoverable-table">

                    
                   
                    <hr>
                    <h1>Project Name :{{$project->name}}</h1>
                    
                    <p>Description : {{$project->description}}</p>
                    <p>status : {{$project->status}}</p>
                    <p>start_date : {{$project->start_date}}</p>
                    <p>end_date : {{$project->end_date}}</p>

                    <h1> the Employees of project</h1>
                    <?php $i = 0 ?>
                    
                    @foreach ($project->employees as $employee )
                    <?php $i++ ?>
                        <h1> </h1>
                        <h2>{{ $i}} -<a href="{{route('project.employees',$project->id)}}">{{$employee->name}}</a></h2>
                    @endforeach
                    {{-- <h2>Number of Employees<a href="{{route('project.employees',$project->id)}}">{{App\Models\EmployeeProject::where('project_id',$project->id)->count()}}</a></h2> --}}
                    
                    {{-- <h3>{{$project->client->first_name}}</h3> --}}


                    @foreach($project->images as $image)

                   
                    <img src="{{asset('projects/images/'.$project->name.'/'.$image->image)}}" 
                    style="width:150px; height:150px;"> </td>
                    
                   
                    @endforeach
                   
                 
                     </div>
                     <iframe src=""></iframe>
                     <iframe src={{asset('projects/file/'.$project->name.'/'. $project->document)}} width='1366px' height='623px' frameborder='0'>This is an embedded 
                        <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by 
                        <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe>
                  <hr>
                </div>
               
            </div>

        </div>
    </div>
    <!--/div-->

   
</div>

</div>
<!-- /row -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<!--Internal  Datatable js -->
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
<!-- Internal Modal js-->
<script src="{{ URL::asset('assets/js/modal.js') }}"></script>

<script>
    $('#modaldemo8').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var user_id = button.data('user_id')
        var username = button.data('username')
        var modal = $(this)
        modal.find('.modal-body #user_id').val(user_id);
        modal.find('.modal-body #username').val(username);
    })

</script>


@endsection