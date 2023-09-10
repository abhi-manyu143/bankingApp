@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card" style="margin-top: 56px; padding: 8px;">
                    <div class="card-header" style="font-weight: bold;">Account Statement</div>
                    <div class="card-body" style="display: flex;">
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>DATE AND TIME</th>
                                    <th>AMOUNT</th>
                                    <th>TYPE</th>
                                    <th>DETAILS</th>
                                    <th>BALANCE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 1 @endphp
                                @foreach ($account_statement as $item)
                                <tr>
                                    <td>{{$counter++}}</td>
                                    <td>{{\Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i A' )}}</td>
                                    <td>{{$item->transaction_amount}}</td>
                                    <td>{{$item->type}}</td>
                                    <td>{{$item->details}}</td>
                                    <td>{{$item->current_balance}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
