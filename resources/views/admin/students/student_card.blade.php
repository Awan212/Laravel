<html>

<head>
    <title>{{ $data->student_name }} | Student Card</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" media="all">
    <style type="text/css">
        @media print {
                @page { margin: 0; }
                body { margin: 1.6cm; }
        }
    </style>
</head>

<body>
    <button class="btn btn-primary btn-print float-right noprint">Print</button>

    <div class="row m-5 border w-50">
        <div class="col-sm-4  text-center">
            <div style="width:200px; height:200px; border:2px solid #303030; background:#fff;">
                <img src="{{ asset($data->student_profile_pic) }}" alt="" width="100%" height="100%">
            </div>
            <span class="d-block">Student #:</span>
            <span class="d-block h5">{{ $data->student_roll_no }}</span>
        </div>

        <div class="col-sm-8">
            <p class="h1 text-center">The Grammer School</p>
            <div class="row">
                <div class="col-sm-6">
                    <span class="d-block">Student Name:</span>
                    <span class="d-block h4">{{ $data->student_name }}</span>
                </div>
                <div class="col-sm-6">
                    <span class="d-block">Father Name:</span>
                    <span class="d-block h4">{{ $data->student_father_name }}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <span class="d-block">Date of Birth:</span>
                    <Address class="d-block h5">{{ $data->dob }}</Address>
                </div>
                <div class="col-sm-6">
                    <span class="d-block">Class & Section:</span>
                    <span class="d-block h5">{{ $data->class->class_title }} -- {{ $data->class->section_name  }}
                    </span>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-6">
                    <span class="d-block">Address:</span>
                    <Address class="d-block h5">{{ $data->student_address }}</Address>
                </div>
                <div class="col-sm-6">
                    <span class="d-block">Phone #:</span>
                    <Address class="d-block h5">{{ $data->student_guardian_phone_no }}</Address>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            $(".btn-print").on('click', function () {
                window.print();
            });
        });
    </script>
</body>
</html>