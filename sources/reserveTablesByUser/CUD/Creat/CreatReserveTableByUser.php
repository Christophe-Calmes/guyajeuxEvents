<?php
//encodeRoutage(50)
require('../sources/reserveTablesByUser/objects/SQLAcessReserTables.php');
print_r($_POST);
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['numberOfPeople']));
array_push($controlePostData, $checkId->controleInteger($_POST['idTable']));
array_push($controlePostData, $checkId->controleInteger($_POST['idActivity']));
array_push($controlePostData, $checkId->controleInteger($_POST['idConsommation']));
array_push($controlePostData, sizePost($_POST['comment'], 750));
$mark = [1, 1, 1, 1, 0];
// Contrôle date vs sheduling shop 
$dateReverseByCustomer = filter($_POST['dateReserve']);
echo '<br/>';
print_r($dateReverseByCustomer);

echo '<br/>';
$checkDateShedulingShop = new SQLAcessReserTables();


if(($mark == $controlePostData)&&($checkDateShedulingShop->checkAReserveDate(filter($_POST['dateReserve'])))){
    echo '<br/>';
    echo 'Record reserved possible<br/> // Test endOfReserve';
    $parametre = new Preparation();
    $param = $parametre->creationPrepIdUser ($_POST);
    print_r($param);
    $checkDateShedulingShop->addReservedTableByUser($param);
} else {
    echo 'Pas coucou';
}