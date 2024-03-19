<?php
  function format_identity($identity) {
    $identity = strtoupper($identity);
    $count = 0;
    $new_identity = "";

    if(!strcmp(substr($identity, 0, 2), "V-")) {
      $identity = substr($identity, 2);
    }

    for($i = strlen($identity)-1; $i >= 0; $i--) {
      $count++;
      if($count == 4 && strcmp($identity[$i], ".")) {
        $count = 1;
        if(strcmp($identity[$i], ".")) {
          $new_identity = ".$new_identity";
        }
      }
      $new_identity = $identity[$i] . $new_identity;
    }
 
    $new_identity = "V-" . $new_identity;

    return $new_identity;
  }
?>