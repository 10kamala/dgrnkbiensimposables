<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{   
header('location:index.php');
}else{
if(isset($_POST['update']))
{
$did = intval($_GET['provid']);    
$provname = $_POST['provincename'];
$provcode = $_POST['provcode'];   
$provshortname = $_POST['provinceshortname'];
$sql = "update tprovince set ProvinceName=:provname,ProvinceCode=:provcode,ProvinceShortName=:provshortname where id=:did";
$query = $dbh->prepare($sql);
$query->bindParam(':provname', $provname, PDO::PARAM_STR);
$query->bindParam(':provcode', $provcode, PDO::PARAM_STR);
$query->bindParam(':provshortname', $provshortname, PDO::PARAM_STR);
$query->bindParam(':did', $did, PDO::PARAM_STR);
$query->execute();
$msg="Province updated Successfully";
}
?><!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Title -->
        <title>Admin | Mis à jour de la province</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet"> 
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
<style>
.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
</style>
</head>
<body>
  <?php include('includes/header.php');?>          
       <?php include('includes/sidebar.php');?>
            <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title">Mis à jour de la province</div>
                    </div>
                    <div class="col s12 m12 l6">
                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <form class="col s12" name="chngpwd" method="post">
                                          <?php if($error){?><div class="errorWrap"><strong>erreur</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                                            else if($msg){?><div class="succWrap"><strong>success</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                            <?php 
                                            $did = intval($_GET['provid']);
                                            $sql = "SELECT * from tprovince WHERE id=:did";
                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':did', $did, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if($query->rowCount() > 0)
                                            {
                                            foreach($results as $result)
                                            { ?>  

                                            <div class="row">
                                            <div class="input-field col s12">
                                                <input id="provincename" type="text"  class="validate" autocomplete="off" name="provincename" value="<?php echo htmlentities($result->ProvinceName); ?>" required>
                                                <label for="provname">Nom du centre</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <input id="provinceshortname" type="text"  class="validate" autocomplete="off" name="provinceshortname" value="<?php echo htmlentities($result->ProvinceShortName); ?>" required>
                                                <label for="provshortname">Abrévéation du nom du centre</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <input id="provcode" type="text" name="provcode" class="validate" autocomplete="off" value="<?php echo htmlentities($result->ProvinceCode); ?>" required>
                                                <label for="password">Code du centre</label>
                                            </div>
                                            <?php }} ?>
                                           <div class="input-field col s12">
                                            <button type="submit" name="update" class="waves-effect waves-light btn indigo m-b-xs">Modifier</button>
                                            </div>
                                        </div>                                     
                                    </form>
                                </div>
                            </div>
                        </div>                 
                    </div>               
                </div>
            </main>
        </div>
        <div class="left-sidebar-hover"></div>
        
        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/form_elements.js"></script>
        
    </body>
</html>
<?php } ?> 