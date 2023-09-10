@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card" style="margin-top: 56px; padding: 8px;">
                <div class="card-header" style="font-weight: bold;">Welcome {{ Auth::user()->name }}</div>

                <div class="card-body" style="display: flex;">
                    <div class="option_in" style="font-weight: bold; opacity: 40%;">YOUR ID</div>
                    <div  class="mail_id" style="margin-left: 121px;">{{ Auth::user()->email }}</div>    
                </div>
                <div class="card-body" style="display: flex;">
                    <div class="option_in" style="font-weight: bold; opacity: 40%;" >ACCOUNT BALANCE</div>
                    @if(!empty($amount))
                    <div  class="mail_id" style="margin-left: 60px;">{{ $amount }} INR</div>
                    @else
                    <div  class="mail_id" style="margin-left: 60px;">0.00 INR</div>   
                    @endif 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
