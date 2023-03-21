<?php
    if (isset($_GET['input'])){
        $e= htmlspecialchars($_GET['input']);
        echo (float)$e*0.1;
    }
?>