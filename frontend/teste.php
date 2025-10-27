<?php
echo password_hash('123456', PASSWORD_DEFAULT). "\n";
$saida= password_hash('123456', PASSWORD_DEFAULT);


$options=['cost => 11'];

#echo password_hash('123456',PASSWORD_BCRYPT,$options);

if (password_verify('123456', $saida)){

     echo 'Bateu';
}else{
echo 'zebra';
}

