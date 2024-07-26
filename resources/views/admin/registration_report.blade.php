
<!-- resources/views/vendors/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1 class="text-pretty bg-gray-50">Resigstration Report</h1>
    <table class="table table-bordered table-striped table-hover table-responsive mt-5" id="registration-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Source</th>
                <th># of Registrations</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach($report as $row)
            <tr>
                <td>{{ $row->date }}</td>
                <td>{{ $row->source }}</td>
                <td>{{ $row->registrations }}</td>
            </tr> --}}
            {{-- @endforeach --}}
        </tbody>
    </table>

@endsection


@section('scripts')
<script >
$(document).ready(function() {

    var table = $('#registration-table').DataTable({
       processing: true,
       serverSide: true,
       searching: false,
       // dom: 'Bfrtip',
       // buttons: [
       //     'copy', 'csv', 'excel', 'pdf', 'print'
       // ],
       ajax: {
           url: '{{ route('admin.registration_report') }}',
           type: 'GET',
       },
       columns: [
                { data: 'date', name: 'date' },
                { data: 'source', name: 'source' },
                { data: 'registrations', name: 'registrations' },
            ]
    });
});
</script>
@endsection