<?php

echo \kato\DropZone::widget([
       'options' => [
       		'url' => 'index.php?r=branch/upload',
           'maxFilesize' => '2', //Mb
       ],
       'clientEvents' => [
           'complete' => "function(file){console.log(file)}",
           'removedfile' => "function(file){alert(file.name + ' is removed')}"
       ],
   ]);
?>