<?php
  use App\Models\Patient;
  $patients = Patient::all()->toArray();
  $apis = config('emr.apis');
  foreach($patients as $key => $patient){
    $emr = $patient->emr;
    $org = $patient->organization;
    $client_id = $org->client_id;
    $secrete_key = $org->secrete_key;
    if($emr->access_token_is_active){
        //fitbit
        processFitbit($patient);
    }else{
        $data = [
            "grant_type"=>"refresh_token",
            "refresh_token"=>"refresh_token",
            "client_id"=>$client_id
        ];
        $response = processAccessToken($apis['emr_auth_url'],$data,'',$client_id,$secrete_key,$org->id,'emr');        
        
    }

  }


  function processFitbit(Patient $patient){
        $client_id = env("FITBIT_CLIENT_ID");
        $secrete_key = env("FITBIT_SECRETE_KEY");
        $apis = config('emr.apis');
        if($patient->fitbit->access_token_is_active){
            
        }else{
            $data = [
                "grant_type"=>"refresh_token",
                "refresh_token"=>"refresh_token",
                "client_id"=>$client_id
            ];
            $response = processAccessToken($apis['fitbit_auth_url'],$data,'',$client_id,$secrete_key,$patient->organization->id,'fitbit');        

        }
  }
?>