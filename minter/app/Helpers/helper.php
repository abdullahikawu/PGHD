<?php

function generatePatientID(){
    return date("ym").rand(100, 999).date('is');
}

