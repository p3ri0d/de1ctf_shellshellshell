<?php
if(!$C->check_login())
{
    header('Location: index.php?action=login');
    exit;
}
$data = $C->showmess();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link href="static/bootstrap.min.css" rel="stylesheet">
    <script src="static/jquery.min.js"></script>
    <script src="static/bootstrap.min.js"></script>
</head>
<body>
<a href="index.php?action=logout">logout</a>
<center>

    <div class="container" style="margin-top:101px">
        <h4>Hi <a href="index.php?action=profile"><?php echo $C->username; ?></a></h3><br>
        <h5><a href="index.php?action=publish">publish</a></h4><br>

        <?php
        if($data)
        {
            $data = json_decode($data, true);
            if($data['code']==2 && $C->is_admin ==1)
            {
                for($i=1; $i<count($data['data']); $i++)
                {
                    $img = $data['data'][$i];

                    echo "<img src='/adminpic/$img'><br>";
                }
            }
            else
            {
                echo '<div class="panel-group" id="accordion">';
                for($i=0; $i<count($data['data']); $i++)
                {
                    ?>

                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo date("Y-m-d H:i",$data['data'][$i]['mood']['date'])."&nbsp;&nbsp;".$data['data'][$i]['country'];?> &nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?action=delete&delid=<?php echo $data['data'][$i]['id'];?>"><img src='img/del.png'></a></h3>
                        </div>
                        <div class="panel-body">
                            <?php
                            echo htmlentities($data['data'][$i]['sig'])."<br><br>";
                            $mood = (int)$data['data'][$i]['mood']['mood'];
                            echo "<img src='img/$mood.gif'><br><br>";
                            echo "published：".$data['data'][$i]['subtime']."<br>";
                            

                            ?>
                        </div>
                    </div>
                    <?php
                }
            }
            echo '</div>';
        }
        ?>
    </div>
    <br>
    <br>
    <a href="index.php?action=index"><img src='img/home.png'></a>
</center>
</body>
</html>

