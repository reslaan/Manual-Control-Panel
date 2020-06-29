<?php
include('db/connect.php');

?>

<?php

$state =null;


function rows()
{
    include('db/connect.php');
    $sql = "SELECT  * FROM manual_control  ";
    $limit = mysqli_query($connect, $sql);
    mysqli_close($connect);
    return mysqli_num_rows($limit);
}


    include('db/connect.php');

if (isset($_POST['forword'])) {
    $state = 'forword';
} elseif (isset($_POST['L'])) {
    $state = 'L';
} elseif (isset($_POST['stop'])) {
    $state = 'stop';
} elseif (isset($_POST['R'])) {
    $state = 'R';
} elseif (isset($_POST['backword'])) {
    $state = 'backword';
}



if ((rows() < 28) and !(isset($_POST['clean'])) ) {
    if (isset($_POST[$state])) {
        $sql = "INSERT INTO manual_control ($state) VALUES('$state')";
        $result = mysqli_query($connect, $sql);
        if (!$result) {
            die('error in query');
        }
    }
} elseif((isset($_POST[$state]))) {
    $message = "You should clean the board to add new movements";
    echo "<script type='text/javascript'>alert('$message');</script>";
}




$sql = "SELECT  * FROM manual_control  LIMIT 28";
$result = mysqli_query($connect, $sql);
mysqli_close($connect);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style1.css">
    <title>Document</title>
</head>

<body>



    <header class="header">
        <div class="div-header">
            <img src="img/logo.jpg" alt="logo" >
        </div>
    </header>
    <h1 class="title">Initial Control panel</h1>
    <section class="maincontent">
        <div class="div-button box">
            <form method="POST">

                <button class="button button1" type="submit" name="forword" ><svg>
                        <text x="-33" y="60" font-size="80px" fill="blue" text-anchor="middle" style=" transform: rotate(270deg);">&#10162;</text>
                    </svg> </button>
                <br>
                <button class="button button2" type="submit" name="L" ><svg>
                        <text x="-32" y="-6" font-size="80px" fill="blue" text-anchor="middle" style=" transform: rotate(-180deg);">&#10162;</text>
                    </svg></button>
                <button class="button button3" type="submit" name="stop" ><svg>
                        <text class="button" x="33" y="40" stroke="" fill="white" text-anchor="middle" font-size="20px">
                            STOP</text></svg> </button>
                <button class="button button4" type="submit" name="R" ><svg><text x="32" y="62" font-size="84px" fill="blue" text-anchor="middle">&#10162;</text></svg></button>
                <br>
                <button class="button button5" type="submit" name="backword" ><svg><text x="35" y="-4" font-size="84px" fill="blue" text-anchor="middle" style=" transform: rotate(90deg);">&#10162;</text></svg></button>

        </div>
        </form>

        <div class="div-moves box">
            <ul>
                <?php
                if(mysqli_num_rows($result) > 0){
                if (isset($_POST[$state])) {
                    while ($states = mysqli_fetch_assoc($result)) {
                        echo '<li>' . $states['forword']  . $states['L'] . $states['stop'] . $states['R'] . $states['backword'] . '</li>';
                    }
                }else{
                    include('db/connect.php');
                    $sql = "DELETE FROM manual_control ";
                    $result = mysqli_query($connect, $sql);
    
                    echo '<h1 style= "margin:40% 20% ;border-radius:3px; color:white; background-color:red; " >'.'Movements have been deleted' . '<h1>';
                }
            }
                ?></ul>

            <!-- <?php mysqli_free_result($result); ?> -->

        </div>


    </section>
    <form class="cleanform " method="$_POST">
        <input class="clean " type="submit" name="clean" value="clean"> </input>
    </form>
    <footer class="footer"> writen by Reslaan Alobeidi</footer>


</body>

</html>