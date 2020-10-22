<html>
<head>

    <title>{{ $data['fee']->student_fees->students->student_name }} | Fee Voucher</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/printcss.css')}}" rel="stylesheet" media="all">
    <style type="text/css" media="print">
        @page {
            size: auto;
            /* auto is the initial value */
            margin: 10mm;
            height: 100%;
            /* this affects the margin in the printer settings */
        }
    </style>
</head>

<body>

    <button class="btn btn-primary btn-print float-right noprint">Print</button>

    <div class="row fee-voucher" id="feeVoucher">
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-7 m-auto">
                    <h1>The Grammer School</h1>
                </div>
                <div class="col-sm-12 m-auto">
                    <h3>Parent Copy</h3>
                </div>
                <div class="col-sm-10 ml-auto">
                    <h4>Last Date: {{ Carbon\Carbon::createFromDate(null, null, 10)->format('jS F Y') }}</h4>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="heading">Invoice No:</span>
                        </div>
                        <div class="col-sm-6">
                            <h4>{{ $data['fee']->invoice_number }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="heading">Name: </span>
                        </div>
                        <div class="col-sm-6">
                            <h4>{{ $data['fee']->student_fees->students->student_name }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="heading">Father Name: </span>
                        </div>
                        <div class="col-sm-6">
                            <h4>{{ $data['fee']->student_fees->students->student_father_name }}</h4>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="heading">Class: </span>
                        </div>
                        <div class="col-sm-6">
                            <h4>{{ $data['fee']->student_fees->students->class->class_title }} |
                                {{ $data['fee']->student_fees->students->class->section_name }}</h4>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="heading">Fee of Month: </span>
                        </div>
                        <div class="col-sm-6">
                            <h4>{{ Carbon\Carbon::parse($data['fee']->fee_of_month)->format('F Y') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fee </th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td colspan="2">Total</td>
                                <td>
                                    @if( \Carbon\Carbon::createFromDate(null, null, null)->format('j-m-Y') >= \Carbon\Carbon::createFromDate(null, null, 15)->format('j-m-Y') )
                                        Rs. {{ $data['fee']->fee_amount + $data['attendance_fine'] * 100 + 500 }}
                                    @else
                                        Rs. {{ $data['fee']->fee_amount + $data['attendance_fine'] * 100 }}
                                    @endif
                                </td>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{ Carbon\Carbon::parse($data['fee']->fee_of_month)->format('F Y') }}</td>
                                <td>Rs.{{ $data['fee']->fee_amount }}</td>
                            </tr>
                            @isset($data['attendance_fine'])
                            <tr>
                                <td>2</td>
                                <td>Attendance Fine</td>
                                <td>Rs. {{ $data['attendance_fine'] * 100 }}</td>
                            </tr>
                            @else
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endisset
                            @if( \Carbon\Carbon::createFromDate(null, null, null)->format('j-m-Y') >= \Carbon\Carbon::createFromDate(null, null, 15)->format('j-m-Y'))
                            <tr>
                                <td>3</td>
                                <td>Late Fee Fine</td>
                                <td>Rs. 500</td>
                            </tr>
                            @else
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @endif
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-sm-8 m-auto">
                    <span>Fine charge 100 rupees per day after due date.</span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-7 m-auto">
                    <h1>The Grammer School</h1>
                </div>
                <div class="col-sm-12 m-auto">
                    <h3>Bank Copy</h3>
                </div>
                <div class="col-sm-10 ml-auto">
                    <h4>Last Date: {{ Carbon\Carbon::createFromDate(null, null, 10)->format('jS F Y') }}</h4>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="heading">Invoice No:</span>
                        </div>
                        <div class="col-sm-6">
                            <h4>{{ $data['fee']->invoice_number }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="heading">Name: </span>
                        </div>
                        <div class="col-sm-6">
                            <h4>{{ $data['fee']->student_fees->students->student_name }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="heading">Father Name: </span>
                        </div>
                        <div class="col-sm-6">
                            <h4>{{ $data['fee']->student_fees->students->student_father_name }}</h4>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="heading">Class: </span>
                        </div>
                        <div class="col-sm-6">
                            <h4>{{ $data['fee']->student_fees->students->class->class_title }} |
                                {{ $data['fee']->student_fees->students->class->section_name }}</h4>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="heading">Fee of Month: </span>
                        </div>
                        <div class="col-sm-6">
                            <h4>{{ Carbon\Carbon::parse($data['fee']->fee_of_month)->format('F Y') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fee </th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td colspan="2">Total</td>
                                <td>
                                    @if( \Carbon\Carbon::createFromDate(null, null, null)->format('j-m-Y') >= \Carbon\Carbon::createFromDate(null, null, 15)->format('j-m-Y') )
                                        Rs. {{ $data['fee']->fee_amount + $data['attendance_fine'] * 100 + 500 }}
                                    @else
                                        Rs. {{ $data['fee']->fee_amount + $data['attendance_fine'] * 100 }}
                                    @endif
                                </td>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{ Carbon\Carbon::parse($data['fee']->fee_of_month)->format('F Y') }}</td>
                                <td>Rs.{{ $data['fee']->fee_amount }}</td>
                            </tr>
                            @isset($data['attendance_fine'])
                            <tr>
                                <td>2</td>
                                <td>Attendance Fine</td>
                                <td>Rs. {{ $data['attendance_fine'] * 100 }}</td>
                            </tr>
                            @else
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endisset
                            @if( \Carbon\Carbon::createFromDate(null, null, null)->format('j-m-Y') >= \Carbon\Carbon::createFromDate(null, null, 15)->format('j-m-Y'))
                            <tr>
                                <td>3</td>
                                <td>Late Fee Fine</td>
                                <td>Rs. 500</td>
                            </tr>
                            @else
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @endif
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-sm-8 m-auto">
                    <span>Fine charge 100 rupees per day after due date.</span>
                </div>
            </div>

        </div>

        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-7 m-auto">
                    <h1>The Grammer School</h1>
                </div>
                <div class="col-sm-12 m-auto">
                    <h3>Office Copy</h3>
                </div>
                <div class="col-sm-10 ml-auto">
                    <h4>Last Date: {{ Carbon\Carbon::createFromDate(null, null, 10)->format('jS F Y') }}</h4>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="heading">Invoice No:</span>
                        </div>
                        <div class="col-sm-6">
                            <h4>{{ $data['fee']->invoice_number }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="heading">Name: </span>
                        </div>
                        <div class="col-sm-6">
                            <h4>{{ $data['fee']->student_fees->students->student_name }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="heading">Father Name: </span>
                        </div>
                        <div class="col-sm-6">
                            <h4>{{ $data['fee']->student_fees->students->student_father_name }}</h4>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="heading">Class: </span>
                        </div>
                        <div class="col-sm-6">
                            <h4>{{ $data['fee']->student_fees->students->class->class_title }} |
                                {{ $data['fee']->student_fees->students->class->section_name }} </h4>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="heading">Fee of Month: </span>
                        </div>
                        <div class="col-sm-6">
                            <h4>{{ Carbon\Carbon::parse($data['fee']->fee_of_month)->format('F Y') }} </h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fee </th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td colspan="2">Total</td>
                                <td>
                                    @if( \Carbon\Carbon::createFromDate(null, null, null)->format('j-m-Y') >= \Carbon\Carbon::createFromDate(null, null, 15)->format('j-m-Y') )
                                        Rs. {{ $data['fee']->fee_amount + $data['attendance_fine'] * 100 + 500 }}
                                    @else
                                        Rs. {{ $data['fee']->fee_amount + $data['attendance_fine'] * 100 }}
                                    @endif
                                </td>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{ Carbon\Carbon::parse($data['fee']->fee_of_month)->format('F Y') }}</td>
                                <td>Rs.{{ $data['fee']->fee_amount }}</td>
                            </tr>
                            @isset($data['attendance_fine'])
                            <tr>
                                <td>2</td>
                                <td>Attendance Fine</td>
                                <td>Rs. {{ $data['attendance_fine'] * 100 }}</td>
                            </tr>
                            @else
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endisset
                            @if( \Carbon\Carbon::createFromDate(null, null, null)->format('j-m-Y') >= \Carbon\Carbon::createFromDate(null, null, 15)->format('j-m-Y'))
                            <tr>
                                <td>3</td>
                                <td>Late Fee Fine</td>
                                <td>Rs. 500</td>
                            </tr>
                            @else
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @endif
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-sm-8 m-auto">
                    <span>Fine charge 100 rupees per day after due date.</span>
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