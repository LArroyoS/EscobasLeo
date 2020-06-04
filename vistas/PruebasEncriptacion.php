<?php

    $clave = 'qwerty78';
    echo md5($clave);
    echo '<br/>';
    echo sha1($clave);
    echo '<br/>';

    //hash(alg, string)

    foreach( hash_algos() as $algoritmo){

        echo $algoritmo." : ".hash($algoritmo,$clave).'<br/>';

    }

    echo '<br/>';

    //password_hash()

    $hash = password_hash($clave,PASSWORD_DEFAULT,['cost' => 10]);
    echo $hash;

    echo '<br/>';

    //password_verify()

    if(password_verify($clave, $hash)){

        echo 'El password es correcto';

    }

?>