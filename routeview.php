<?php 
    session_start();
    // if(!isset($_SESSION["id"])){
    //     header('Location:signin.php');
    //     exit();
    // }
	require_once("inc/connection.php");
    require_once("inc/calculations_inc.php");
    // $result=mysqli_query($connection,"SELECT * FROM city ORDER BY name ASC");
    // $data = array();
    // foreach($result as $row)
    // {
    //     $data[] = array(
    //         'label'     =>  $row["name"],
    //         'value'     =>  $row["name"]
    //     );
    // }
?>
<?php
    $query2 = "SELECT vassign.r_id,vassign.v_id,vehicle.name,vehicle.nic,vehicle.reg_num,vehicle.seats,vehicle.model,vehicle.air,vehicle.contact,user.f_name FROM vassign INNER JOIN vehicle ON vassign.v_id=vehicle.v_id INNER JOIN user ON user.u_id=vehicle.u_id WHERE vassign.r_id=?;";
    $stmt2 = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt2,$query2)){
        header('Location:index.php');
        exit();
    }
    mysqli_stmt_bind_param($stmt2,"s",$_GET['id']);
    mysqli_stmt_execute($stmt2);
    $hh = mysqli_stmt_get_result($stmt2);
    mysqli_stmt_close($stmt2);
    $vehicle = mysqli_fetch_assoc($hh);

    $query3 = "SELECT stops.s_id,stops.r_id,city.name from stops INNER JOIN city on city.c_id=stops.c_id WHERE stops.r_id = ? ORDER by stops.s_id ASC;";
    $stmt3 = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt3,$query3)){
        header('Location:index.php');
        exit();
    }
    mysqli_stmt_bind_param($stmt3,"i",$_GET['id']);
    mysqli_stmt_execute($stmt3);
    $startName = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt3));
    mysqli_stmt_close($stmt3);

    $query4 = "SELECT stops.s_id,stops.r_id,city.name from stops INNER JOIN city on city.c_id=stops.c_id WHERE stops.r_id = ? ORDER by stops.s_id DESC;";
    $stmt4 = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt4,$query4)){
        header('Location:index.php');
        exit();
    }
    mysqli_stmt_bind_param($stmt4,"i",$_GET['id']);
    mysqli_stmt_execute($stmt4);
    $endName = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt4));
    mysqli_stmt_close($stmt4);
    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo strtoupper($startName['name'])." - ".strtoupper($endName['name'])." ";?>Route</title>

    <script src="dashboard/library/autocomplete.js"></script>

    <link rel="stylesheet" href="./styles/login.css" />
    <link rel="stylesheet" href="./styles/footer.css" />
    <link rel="stylesheet" href="./styles/index.css" />
    <link rel="stylesheet" href="css/routeview.css" />
    <link rel="stylesheet" href="css/dashboard.css" />
        
    <?php include_once("header.php") ?>
    
    <div class="mainroute container">
        <h1 class="route-name"><?php echo strtoupper($startName['name'])." - ".strtoupper($endName['name'])." ";?><span>#<?php echo $_GET['id'] ?></span></h1>
        <p>added by <?php echo $vehicle['f_name'];?></p>
        <div class="route-bus">
            <div class="route-bus-pic">
                <img src="img/bus.jpg" alt="yellow bus">
            </div>
            <div class="route-bus-details">
                <div class="bus-detail"><span>Reg-No: </span><?php echo $vehicle['reg_num'];?></div>
                <div class="bus-detail"><span>Seats: </span><?php echo $vehicle['seats'];?></div>
                <div class="bus-detail"><span>Model: </span><?php echo $vehicle['model'];?></div>
                <div class="bus-detail"><?php if($vehicle['air']==1)echo "AC"; else echo "non-AC"; ?></div>
                <div class="bus-detail"><?php echo $vehicle['name'];?></div>
                <div class="bus-detail"><?php echo $vehicle['contact']; ?><a href="tel:<?php echo $vehicle['contact'] ?>"><input type="button" class="butt-add" value="Contact"></a></div>
            </div>
        </div>
        <div class="turn-section-name">Turns <i class="fa-solid fa-turn-down"></i></div>
                    <?php
                    $c = 0;
                    $query5 = "SELECT turn.t_id,time_table.tim FROM turn INNER JOIN time_table ON turn.t_id=time_table.t_id WHERE turn.r_id=? GROUP BY time_table.t_id ORDER BY time_table.tim ASC;";
                    $stmt5 = mysqli_stmt_init($connection);
                    if(!mysqli_stmt_prepare($stmt5,$query5)){
                        header('Location:index.php');
                        exit();
                    }
                    mysqli_stmt_bind_param($stmt5,"s",$_GET['id']);
                    mysqli_stmt_execute($stmt5);
                    $turns = mysqli_stmt_get_result($stmt5);
                    mysqli_stmt_close($stmt5);
                    
                    foreach($turns as $tt){
                        $c++;
                        echo "<div class='turns-body'>";
                        echo "<div class='turns-head'>Turn ".$c."</div>";
                        echo "<div class='turns-turn'>";

                        $query6 = "SELECT * FROM time_table WHERE t_id=?";
                        $stmt6 = mysqli_stmt_init($connection);
                        if(!mysqli_stmt_prepare($stmt6,$query6)){
                            header('Location:index.php');
                            exit();
                        }
                        mysqli_stmt_bind_param($stmt6,"s",$tt["t_id"]);
                        mysqli_stmt_execute($stmt6);
                        $times = mysqli_stmt_get_result($stmt6);
                        mysqli_stmt_close($stmt6);

                        $nfturns = mysqli_num_rows($times);
                        $scount = 1;
                        foreach ($times as $clock) {

                            $query7 = "SELECT city.name FROM stops INNER JOIN city ON city.c_id = stops.c_id WHERE s_id=?;";
                            $stmt7 = mysqli_stmt_init($connection);
                            if(!mysqli_stmt_prepare($stmt7,$query7)){
                                header('Location:index.php');
                                exit();
                            }
                            mysqli_stmt_bind_param($stmt7,"s",$clock["s_id"]);
                            mysqli_stmt_execute($stmt7);
                            $stop = mysqli_stmt_get_result($stmt7);
                            mysqli_stmt_close($stmt7);

                            $g=mysqli_fetch_assoc($stop);
                            
                            echo "<div class='turns-stop'><div class='turn-stop-name'>".$g['name']."</div><div class='turn-stop-time'>".setTime($clock['tim'])."</div></div>";
                            if($scount!=$nfturns) echo "<i class='fa-solid fa-arrow-right'></i>";
                            $scount++;
                        }
                        echo "</div></div>";
                    }
                    ?>
    </div>

    <div class="container maincomment">
        
        <?php

        $query8 = "SELECT comment.co_id,comment.u_id,user.f_name,comment.dates,comment.message,comment.rating FROM `comment` INNER JOIN user ON comment.u_id=user.u_id WHERE comment.r_id=? ORDER BY comment.co_id DESC";
        $stmt8 = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt8,$query8)){
            header('Location:index.php');
            exit();
        }
        mysqli_stmt_bind_param($stmt8,"s",$_GET['id']);
        mysqli_stmt_execute($stmt8);
        $comments = mysqli_stmt_get_result($stmt8);
        mysqli_stmt_close($stmt8);

        ?>
        <div class="comment">
            <div class="turn-section-name">Comments</div>
            <?php if(!isset($_SESSION['id'])){?>
            <div class="not-login-comment">Only users can comment here. <a href="signin.php">signin</a>/ <a href="signup.php">signup</a></div>
            <?php }else{?>
                <div class="comment-box">
                    <div class="comment-box-rating">
                        <i id="s1" onclick="star(1)" class="fa-solid fa-star"></i>
                        <i id="s2" onclick="star(2)" class="fa-solid fa-star"></i>
                        <i id="s3" onclick="star(3)" class="fa-solid fa-star"></i>
                        <i id="s4" onclick="star(4)" class="fa-solid fa-star"></i>
                        <i id="s5" onclick="star(5)" class="fa-solid fa-star"></i>
                    </div>
                    <div class="comment-box-message">
                        <textarea name="comment" id="comment-msg" cols="30" rows="10" placeholder="Type your comment here."></textarea>
                    </div>
                    <div class="comment-box-btn">
                        <input id="comment-btn" <?php echo "onClick='addcomment(".$_GET['id'].")'";?> type="button" value="Comment">
                    </div>
                </div>
            <?php } ?>    
            <div class="comment-area">
            <?php
            $cc=0;
            foreach($comments as $com){$cc++;?>
                <div class="comment-area-reply">
                    <div class="reply-body">
                        <div class="reply-user-details">
                            <div class="user-name"><?php echo $com['f_name'];?></div>
                            <?php if(isset($_SESSION['id'])){ if($_SESSION['id']==$com['u_id']){?>
                            <div <?php echo "onClick='delcom(".$com['co_id'].")'"?>><i class="fa-solid fa-trash"></i></div>
                            <?php }}?>
                        </div>
                        <div class="reply-added"><?php echo $com['dates'];?>
                        <?php for($i=0;$i< $com['rating'];$i++){?><i class="fa-solid fa-star gold"></i><?php }?>
                        </div>
                        <p class="user-reply"><?php echo $com['message'];?></p>
                    
                        <div class="do-reply" onclick=<?php echo "'showreply(".$cc.")'";?>>Reply <i class="fa-solid fa-reply"></i></div>
                    </div>
                    <?php if(isset($_SESSION['id'])){ ?>
                    <div <?php echo "id='box".$cc."'";?> class="comment-box">
                        <div class="comment-box-message">
                            <textarea name="comment" <?php echo "id='reply-msg".$cc."'";?> cols="30" rows="10" placeholder="Type your reply here."></textarea>
                        </div>
                        <div class="comment-box-btn">
                            <input <?php echo "onClick='addreply(".$com['co_id'].",".$cc.")'";?> type="button" value="Reply">
                        </div>
                    </div> 
                    <!-- <script>$("#cbox<?php echo $cc;?>").hide();</script>  -->
                    <?php } ?>
                    
                    <?php 
                    $query9 = "SELECT reply.re_id,reply.u_id,user.f_name,reply.dates,reply.message FROM reply INNER JOIN user ON user.u_id=reply.u_id WHERE reply.co_id=?;";
                    $stmt9 = mysqli_stmt_init($connection);
                    if(!mysqli_stmt_prepare($stmt9,$query9)){
                        header('Location:index.php');
                        exit();
                    }
                    mysqli_stmt_bind_param($stmt9,"s",$com['co_id']);
                    mysqli_stmt_execute($stmt9);
                    $replys = mysqli_stmt_get_result($stmt9);
                    mysqli_stmt_close($stmt9);

                    foreach($replys as $rep){ ?>
                    <div class="comment-area">
                        <div class="comment-area-reply">
                            <div class="reply-body">
                                <div class="reply-user-details">
                                    <div class="user-name"><?php echo $rep['f_name'];?></div>
                                    <?php if(isset($_SESSION['id'])){ if($_SESSION['id']==$rep['u_id']){?>
                                        <div <?php echo "onClick='delrep(".$rep['re_id'].")'"?>><i class="fa-solid fa-trash"></i></div>
                                    <?php }}?>
                                </div>
                                <div class="reply-added"><?php echo $rep['dates'];?></div>
                                <p class="user-reply"><?php echo $rep['message'];?></p>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
            <?php }?>    
            </div>    
        </div>
    </div>

    <script src="js/routeview.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>

    <?php include_once("footer.php") ?>
