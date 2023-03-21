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
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    اضافة فاتورة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

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
                    <form action="{{route('save.employee')}}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}

                        <div class="col">
                            <label for="inputName" class="control-label">Name</label>
                            <input id="name" name="name" class="form-control" required>
                            
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">Email</label>
                            <input id="email" name="email" class="form-control"required>
                            
                        </div>


                            <div class="col">
                                <label> Birthday</label>
                                <input class="form-control fc-datepicker" name="birthdate" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ date('Y-m-d') }}" required>
                            </div>

                        

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Position</label>
                                <select name="position" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option value="" selected disabled>Select Position </option>
                                    @foreach ($position as $p)
                                        <option value="{{ $p->id }}"> {{ $p->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                           

                            <div class="col">
                                <label for="inputName" class="control-label">Position Salary</label>
                                <select id="p_salary" name="p_salary" class="form-control"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </select>
                            </div>
    
                            
                        </div>
                       
                        {{-- 3 --}}

                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">Addtion Salary</label>
                                <input type="text" class="form-control form-control-lg" id="e_salary"
                                    name="e_salary" title="pleas select commission"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value=0
                                    required>
                            </div>

                        </div>

                        {{-- 4 --}}

    
                            <div class="col">
                                <label for="inputName" class="control-label">Total Salary</label>
                                <input type="text" class="form-control" id="Total" name="Total" readonly>
                            </div>
                       


                        <p class="text-danger">pleas add phone with this types  jpeg ,.jpg , png </p>
                        <h5 class="card-title">Profile Image</h5>

                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="pic" class="dropify" accept=".jpg, .png, image/jpeg, image/png"
                                data-height="70" />
                        </div><br>

                        <div class="form-group">
                            <label> password</label> 
                          
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Save </button>
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
        $(document).ready(function() {
            $('select[name="position"]').on('change', function() {
                var PositionId = $(this).val();
                if (PositionId) {
                    $.ajax({
                        url: "{{ URL::to('p_salary') }}/" + PositionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="p_salary"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="p_salary"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

{{-- calculate Salary Addetion  --}}

    <script>
        function myFunction() {
            var Position_salary = parseFloat(document.getElementById("p_salary").value);
            var Employee_Salary = parseFloat(document.getElementById("e_salary").value);
            
            if (typeof Employee_Salary === 'undefined' || !Employee_Salary) {
                alert('please enter the Addetion_Salary');
                var Total = Position_salary
                document.getElementById("Total").value = Total;
            } else {
                var Total = Position_salary + Employee_Salary;
                sumt = parseFloat(Total).toFixed(2);
                document.getElementById("Total").value = sumt;
            }
        }
    </script>


@endsection