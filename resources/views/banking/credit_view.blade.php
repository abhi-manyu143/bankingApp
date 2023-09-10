@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="margin-top: 56px; padding: 8px;">
                    <div class="card-header" style="font-weight: bold;">Deposit Money</div>

                    <div class="card-body" style="display: flex;">
                        <form id="credit_form">
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
                            <button type="submit" class="btn btn-primary">Deposit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $('#credit_form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{ url('add_amount') }}",
                data: $(this).serialize(),
                success: function(response) {
                    // alert(response.errors);
                    console.log(response.Updated)
                    if (response.errors) {
                        console.log('error');
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
                            title: response.errors
                        })
                    } else if (response.Updated) {
                        Swal.fire(
                            'Success!',
                            response.Updated,
                            'success'
                        )
                        window.location.reload();
                    }
                },
            });
        });
    </script>
@endsection
