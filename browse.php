<?php 
include("includes/includedFiles.php"); 
?>

<h1>You Might Also Like</h1>

<div class="grid-view-container container">
    <div class="row">

        <?php
            $albumQuery = mysqli_query($conn, "SELECT * FROM albums ORDER BY RAND() LIMIT 20");

            while($row = mysqli_fetch_array($albumQuery)) {

                

                echo "
              
                <div class='grid-view-item'>
                <span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>
                        <img src='" . $row['artworkPath'] . "'>
                  
                        <div class='grid-view-info'>"
                            . $row['title'] . 
                        "</div>
                    </span>
       
            
                </div>";
            }
        ?>

    </div>
</div>