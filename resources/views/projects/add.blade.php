@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    اضافة فاتورة
@stop

@section('page-header')

    
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">company</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                     Add Project</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('stre.project')}}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}

                        <div class="col">
                            <label for="inputName" class="control-label">Name</label>
                            <input id="name" name="name" class="form-control"  >
                            <input type="hidden" id="id" name="id" class="form-control" >
                            
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">Descripion</label>
                                <textarea class="form-control" id="exampleTextarea" name="description"  rows="3"></textarea>
                            </div>
                        </div>

                        <br>
                        <div class="col">
                            <label for="inputName" class="control-label">Select Project Status</label>
                            <select name="status" id="status" class="form-control" onchange="myFunction()">
                                <!--placeholder-->
                                <option value="" selected disabled>Select Project Status</option>
                                <option value="new">new</option>
                                <option value="started">started</option>
                                <option value="pending">pending</option>
                                <option value="inprogress">inprogress</option>
                            </select>
                        

                            <div class="col">
                                <label> Start_date</label>
                                <input class="form-control fc-datepicker" name="start_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ date('Y-m-d') }}"  >
                            </div>

                            <div class="col">
                                <label> End_date	</label>
                                <input class="form-control fc-datepicker" name="end_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ date('Y-m-d') }}"  >
                            </div>

                       
                       
                    <br>
                    <div class="col">
                        <p class="text-danger">pleas add phone with this types   jpeg ,.jpg , png </p>
                        <div >
                            <label>Choose Images</label>
                            <input type="file"  name="images[]" multiple>
                            </div>
                    </div>
                        <br>
                    <div class="col">
                        <p class="text-danger">pleas add phone with this types pdf </p>
                        <h5 class="card-title">Document</h5>

                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="document" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                data-height="70" />
                        </div><br>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Save </button>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>
    <script>
        $(document).on('click', '.pending', function(){
            var html = '<div class="col">';
            html += '<div class="col">'
            html += '<label for="exampleTextarea">Reasone</label>';
            html += '<textarea class="form-control" id="exampleTextarea" name="reasone"  rows="3"></textarea>';
            html += ' </div>'
            html +=  '</div>'
            $('#status').append(html);
        });
    </script>
{{-- Y-m-d H:i:s --}}

@endsection