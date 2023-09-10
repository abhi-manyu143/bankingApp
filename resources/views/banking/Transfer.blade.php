@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="margin-top: 56px; padding: 8px;">
                    <div class="card-header" style="font-weight: bold;">Transfer Money</div>

                    <div class="card-body" style="display: flex;">
                        <form id="transfer_form">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email Address </label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Enter Email ID">
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount </label>
                                <input type="number" class="form-control" name="amount" id="amount"
                                    placeholder="Enter Amount">
                            </div>
                            <div class="form-check">
                            </div>
                            <button type="submit" class="btn btn-primary">Transfer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $('#transfer_form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{ url('transfer_amount') }}",
                data: $(this).serialize(),
                success: function(response) {
                    console.log(response.Low_balance)
                    if (response.errors) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'warning',
                            title: response.Low_balance
                        })
                    } else if (response.success) {
                        Swal.fire(
                            'Success!',
                            response.success,
                            'success'
                        )
                        window.location.reload();
                    }
                },
            });
        });
    </script>
@endsection
