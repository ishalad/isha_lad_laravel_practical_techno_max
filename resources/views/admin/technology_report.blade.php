@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Technology Report</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Technology</th>
                <th># of Clients</th>
            </tr>
        </thead>
        <tbody>
            {{-- @dd($report)  --}}
            @foreach($report as $row)
            <tr>
                <td>{{ $row->name }}</td>
                <td>{{ $row->users_count }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
