<?php
    $address=$_GET["address"];
    ?>
<iframe width="100%" height="100%" src="https://maps.google.com/maps?q=<?php if(isset($address)) echo $address; ?>&output=embed"></iframe>
