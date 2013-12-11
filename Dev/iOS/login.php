<?php
    header('Content-type: application/json');
    if($_POST) {
        if($_POST['username'] == 'lama' && $_POST['password'] == 'sticot') {
            echo '{"success":1}';
        } else {
            echo '{"success":0,"error_message":"Login et/ou mot de passe incorrect"}';
        }
    }else {    echo '{"success":0,"error_message":"Login et/ou mot de passe incorrect"}';}
    ?>
