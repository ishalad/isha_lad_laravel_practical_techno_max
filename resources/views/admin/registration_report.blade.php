
<!-- resources/views/vendors/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1 class="text-pretty bg-gray-50">Resigstration Report</h1>
    <table class="table table-bordered table-striped table-hover table-responsive mt-5">
        <thead>
            <tr>
                <th>Date</th>
                <th>Source</th>
                <th># of Registrations</th>
            </tr>
        </thead>
        <tbody>
            @foreach($report as $row)
            <tr>
                <td>{{ $row->date }}</td>
                <td>{{ $row->source }}</td>
                <td>{{ $row->registrations }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection
