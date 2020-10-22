<div class="card shadow ">
    <div class="card-header">
        <h1 class="h3 text-dark float-left">Student Results</h1>
        <button class="btn btn-success float-right btn-add-result ml-1">Add Result</button>
        <button class="btn btn-primary float-right btn-print-result">Print</button>        
    </div>
    <div class="card-body">
    <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Class & Section</th>
                        <th>Result Title</th>
                        <th>Result</th>
                        <th>Acction</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Class & Section</th>
                        <th>Result Title</th>
                        <th>Result</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                   @foreach($data as $key => $result)
                   <tr>
                       <td>{{ $key+1 }}</td>
                       <td>{{ $result->classes->class_title }} | {{ $result->classes->section_name }} </td>
                       <td>{{ $result->result_title }}</td>
                       <td>
                           <a href="/{{$result->result}}" class="btn btn-success">View</a>
                           <a href="/{{$result->result}}" class="btn btn-success" download="{{ $result->result_title }}">Download</a>
                       </td>
                       <td>
                           <button class="btn btn-success btn-edit" data-id="{{ $result->id }}">Edit</button>
                           <button class="btn btn-danger btn-remove" data-id="{{ $result->id }}">Remove</button>
                       </td>
                   </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer"></div>
</div>


<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>