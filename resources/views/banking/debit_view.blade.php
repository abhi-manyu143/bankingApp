@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="margin-top: 56px; padding: 8px;">
                    <div class="card-header" style="font-weight: bold;">Withdarw Money</div>

                    <div class="card-body" style="display: flex;">
                        <form id="debit_form">
                            @csrf
                            <div class="form-group">
                                <label for="amount">Amount </label>
                                <input type="number" class="form-control" name="amount" id="amount"
                                    placeholder="Enter Amount">
                            </div>
                            <div class="form-check">
                                @error('amount')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Withdarw</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $('#debit_form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{ url('withdraw_amount') }}",
                data: $(this).serialize(),
                success: function(response) {
                    console.log(response.Low_balance)
                    if (response.Low_balance) {
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
