<?php
    //$code = $_GET['code'];

use App\Models\Organization;
use App\Models\Patient;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
    $patient = Patient::find(6);//loops all patients
    $org = Organization::find(1);
    $auth_encode = base64_encode($org->client_id.':'.$org->secrete_key);
    $code = $_GET['code'];    
    $redirect_uri = "http://localhost:8000/home";
   $client =  new Client();
   $res = $client->request('POST', "https://emr.vlabnigeria.org/oauth2/default/token", [
    'form_params' =>[
        "grant_type"=>"authorization_code",
        "client_id"=>$org->client_id,
        "redirect_uri"=>$redirect_uri,
        "code"=>$patient->emr_code
    ],
    'auth' => ['username', 'password']
]);
dd($res);
    $response = Http::withHeaders([
        "Content-Type"=>"application/x-www-form-urlencoded",
        "Authorization"=>"Basic $auth_encode"
    ])->post("https://emr.vlabnigeria.org/oauth2/default/token",[
        "grant_type"=>"authorization_code",
        "client_id"=>$org->client_id,
        "redirect_uri"=>$redirect_uri,
        "code"=>$patient->emr_code
    ])->json();    
    echo json_encode($response);    
    dd(
    //    [ "Authorization"=>"Basic ".str_replace('=','',$auth_encode)],
        ["grant_type"=>"authorization_code",
        "client_id"=>$org->client_id,
        "redirect_uri"=>$redirect_uri,
        "code"=>$patient->emr_code]
    );

?>
@extends('layouts.app')
@section('content')
<div style="display: none;" id="cardx">
<div  class="d-flex  justify-content-center align-items-center flex-column">
    <img src="/pix/success.png" width="70px">        
    <div class="alert alert-success my-3" style="font-size: 1em;">
        <strong>Greate!</strong> Fitbit Access Granted Successfully. 
        <div style="max-width: 450px;" class="my-5 bg-white shadow-lg p-3 rounded">
            <h5 style="font-weight: bold;" class="text-center my-3">Click ok to close this page</h5>
            <hr class="mb-4">
            <a onclick="javascript:window.close()" class="btn btn-primary ml-3 w-100">Ok</a>
        </div>
    </div>
</div>
</div> 
<script>
    let pid = localStorage.getItem('pid');
    let code = '{{$code}}';
    (function(){
        document.getElementById('loader').style.display = 'block';
        axios.post('/update_patient',{pid:pid,fitbit_code:code}).then(function(res){
            setTimeout(function(){
                document.getElementById('loader').style.display = 'none';
                document.getElementById('cardx').style.display = 'block';
            }, 2000)
        });
                    
    })()
</script>
@endsection