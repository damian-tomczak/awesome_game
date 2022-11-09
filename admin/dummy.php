<?php include "header.php" ?>
<?php include "menu.php" ?>
<td id="main">
    <h3>Dummy page</h3>
    <p>Contains classes-related tasks that were not included in the final project due to the difficulty of matching them to the project topic.</p>
    <h4>Lab3</h4>
    <div>
        <div id="animacjaTestowa1" class="test-block">Kliknij, a się powiększe</div>
        <div id="animacjaTestowa2" class="test-block">Najedź kursorem, a się powiększe</div>
        <div id="animacjaTestowa3" class="test-block">Kliknij, abym urósł</div>
    </div>
    <h4>Lab4</h4>
    <div>
        <?php
            $i = 0;
            while ($i <= 10) {
                echo $i++;
            }
            echo '<br>application of for loop<br>';
            for ($x = 0; $x < 10;$x++) {
                echo $x;
            }
            echo '<br>application of elseif condition<br>';
            if ($i != 10) {
                echo 'different';
            } elseif ($i == 9){
                echo 'same';
            }
        ?>
    </div>
    <h4>Lab4</h4>
    <div>
        <?php

            $var = '';
            if (isset($_GET['var'])) {
                $var = $_GET['var'];
            }
            $filename = "../$var.php";
            if (file_exists($filename)) {
                header("location: $filename");
            }

            switch ($var) {
            case 1:
                echo 1;
                break;
            case 2:
                echo 2;
                break;
            case 3:
                echo 3;
                break;
            default:
                echo 'unhandled variable content';
                break;
            }
            ?>
        <p>My favorities movies:</p>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/FZqC3_Wrnqg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/Hxf1seOpijE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/Sz19TQfSElU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</td>
<?php include "footer.php" ?>