<?php
$fname = $_GET["fname"];
$fullpath = "../source/uploads/" . $_GET["fname"];

if (!file_exists($fullpath)) {
    die("Bestand bestaat niet!");
}
?>

<img src="<?=$fullpath?>">
<br>
<a href="<?=$fullpath?>"download><button><p>Download foto!</p></button></a>

<style>

    body{
        display:flex;
        justify-content:center;
        align-items: center;
    }

    button{
        margin-top: 4rem;
    width: 30rem;
    height: 10rem;
    background: linear-gradient(90deg, rgb(191, 234, 241) 40%, rgb(148, 208, 233) 60%);
    border-width: 1rem;
    border-color: white;
    box-shadow: 1 1 0 0;
    }

    p{
        display: flex;
        justify-content: center;
        color: white;
        font-size: 2rem;
    }
</style>
