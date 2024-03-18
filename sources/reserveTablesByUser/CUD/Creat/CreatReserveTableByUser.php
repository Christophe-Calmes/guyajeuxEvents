<?php
//encodeRoutage(50)
require('../sources/reserveTablesByUser/objects/SQLAcessReserTables.php');
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['numberPeople']));
array_push($controlePostData, $checkId->controleInteger($_POST['idTable']));
array_push($controlePostData, $checkId->controleInteger($_POST['idActivity']));
array_push($controlePostData, $checkId->controleInteger($_POST['idConsommation']));
array_push($controlePostData, sizePost($_POST['comment'], 750));
$mark = [1, 1, 1, 1, 0, 1, 1, 0];
// Contrôle date vs sheduling shop 
$dateReverseByCustomer = filter($_POST['dateReserve']);
$dateTime = new DateTime(filter($_POST['dateReserve']));
$date = $dateTime->format('Y-m-d');
$dateTime->modify(filter($_POST['endOfReserve']));
$_POST['endOfReserve']=$dateTime->format('Y-m-d\TH:i');
$checkDateShedulingShop = new SQLAcessReserTables();
array_push($controlePostData, $_POST['endOfReserve']>filter($_POST['dateReserve']));
array_push($controlePostData, $checkDateShedulingShop->checkAReserveDate(filter($_POST['dateReserve'])));
array_push($controlePostData,$checkDateShedulingShop->controleDoublonReservation(filter($_POST['idTable']),filter($_POST['dateReserve']), filter($_POST['endOfReserve'])));

if($mark == $controlePostData){
    $parametre = new Preparation();
    $param = $parametre->creationPrepIdUser ($_POST);
    $checkDateShedulingShop->addReservedTableByUser($param);
    echo 'Pas soucis horraire de réservation<br/>';
    print_r($mark);
    echo '<br/>';
    print_r($controlePostData);
    //return header('location:../index.php?message=Réservation enregistré correctement&idNav='.$idNav);
} else {
    echo 'Soucis horraire de réservation<br/>';
    print_r($mark);
    echo '<br/>';
    print_r($controlePostData);
    //return header('location:../index.php?message=Soucis horraire de réservation&idNav='.$idNav);
}