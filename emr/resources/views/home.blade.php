<?php

use App\Models\Patient;

    use Illuminate\Support\Carbon;
    $code = $_GET['code'];    
    $date = Carbon::now();
    $emr_expiry_date = $date->addMonths(3);    
    $fitbit_authorization_link = "https://www.fitbit.com/oauth2/authorize?response_type=code&client_id=238ZZB&scope=activity+cardio_fitness+electrocardiogram+heartrate+nutrition+oxygen_saturation+respiratory_rate+sleep+social+temperature+weight&code_challenge=8_b0QCASCO_nhvaKMqph4kSmGeou48hfW5EdbjPi0EU&code_challenge_method=S256&state=481i1j0i2k3p711s0p0m14015n093a18";                
?>
@extends('layouts.app')
@section('content')
<div style="display: none;" id="cardx">
    <div class="d-flex  justify-content-center align-items-center flex-column">
        <img src="/pix/success.png" width="70px">        
        <div class="alert alert-success my-3" style="font-size: 1em;">
            <strong>Greate!</strong> Access Granted Successfully. 
            <div style="max-width: 450px;" class="my-5 bg-white shadow-lg p-3 rounded">
                <h5 style="font-weight: bold;" class="text-center my-3">Allow This app to fetch your Record from fitbit</h5>
                <hr class="mb-4">
                <a class="btn btn-primary ml-3 w-100" target="_blank" href="{{$fitbit_authorization_link}}">Continue</a>
            </div>
        </div>
    </div>
</div>
<style>
    body{
        background-color: white;
    }
</style>
<script>
    let pid = localStorage.getItem('pid');
    let code = '{{$code}}';    
    (function(){
        document.getElementById('loader').style.display = 'block';
        axios.post('/update_patient',{pid:pid,emr_code:code, emr_expiry_date:'{{$emr_expiry_date}}'}).then(function(res){
            setTimeout(function(){
                document.getElementById('loader').style.display = 'none';
                document.getElementById('cardx').style.display = 'block';
            }, 2000)
        });
    })()
</script>
@endsection

