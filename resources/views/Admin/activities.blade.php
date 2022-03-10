@extends('layouts.AdminLayouts.layout')
@section('content')
<div class="col-12 col-lg-9 border border-dark rounded p-3">
<div class="container">
        <div class="row justify-content-center">
            <h3><i class="fas fa-tasks"></i></i>&nbsp &nbsp Activities</h3>
        </div>
        <hr class="mb-4">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Description</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @if($activities)
                    @foreach($activities as $activity)
                        <tr>
                            <td>{{$activity->description}}</td>
                            <td>{{$activity->date_time}}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection