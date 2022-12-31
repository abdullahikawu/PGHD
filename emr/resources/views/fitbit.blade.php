<?php
    //$code = $_GET['code'];

use App\Models\Organization;
use App\Models\Patient;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
$code = $_GET['code'];
$emr_pid = session('emr_pid');
//echo $emr_pid;
$client_id = env('FITBIT_CLIENT_ID');
$secrete_key = env('FITBIT_CLIENT_SECRET');
$patient = Patient::where('emr_pid',$emr_pid)->first();//loops all patients              
$data = [
    "code"=>$code,
    "client_id"=>$client_id,
    "grant_type"=>"authorization_code",
    "code_verifier"=>$patient->emr->code_challenge,    
]; 

$response = processAccessToken("https://api.fitbit.com/oauth2/token",$data,$patient->emr->code_challenge,$client_id,$secrete_key,$patient->organization_id,'fibit');
echo json_encode($data);
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