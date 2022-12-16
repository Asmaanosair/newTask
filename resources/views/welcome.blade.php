@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
{{--                    <div class="card-header">{{ __('Student') }}</div>--}}

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Employee</th>
                                <th scope="col">Departments</th>
                                <th scope="col">Salaries</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($data as $row)
                                <tr>
                                    <th scope="row">{{$row->id}}</th>
                                    <td>{{$row->name}}</td>
                                    <td>
                                        @foreach($row->department as $item)
                                            {{$item->department}}
                                            <hr>
                                        @endforeach

                                    </td>
                                    <td>
                                        @foreach($row->department as $item)
                                            @foreach($item->salarySpecified as $salary)
                                            {{$salary->salary_salary}}
                                            <hr>
                                        @endforeach
                                        @endforeach
                                    </td>


                                </tr>
                            @empty
                                <tr>
                                    No Data
                                </tr>
                            @endforelse


                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
