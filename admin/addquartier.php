<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{   
header('location:index.php');
}else{
if(isset($_POST['add']))
{
$quartcom = $_POST['quartcom'];
$quartname = $_POST['quartname']; 
$sql = "INSERT INTO tquartier(CommuneId,QuartierName) VALUES(:quartcom,:quartname)";
$query = $dbh->prepare($sql);
$query->bindParam(':quartcom', $quartcom,PDO::PARAM_STR);
$query->bindParam(':quartname', $quartname,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg = "Quartier Created Successfully";
}else{
$error = "Something went wrong. Please try again";
}
}
?><!DOCTYPE html>
<html lang="en">
        <head>           
            <!-- Title -->
            <title>Admin | Add Quartier</title>
            
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
                        <div class="page-title">Création d'un quartier</div>
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="addav">
                                    <div>
                                        <h3>Informations sur le quartier</h3>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m6">
                                                        <div class="row">
                                                         <?php if($error){?><div class="errorWrap"><strong>error</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                                                         else if($msg){?><div class="succWrap"><strong>success</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                                                            <div class="input-field col s12">
                                                        <select name="quartcom" autocomplete="off">
                                                            <option value="">Commune ...</option>
                                                                <?php $sql = "SELECT * from tcommune";
                                                                    $query = $dbh->prepare($sql);
                                                                    $query->execute();
                                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                    $cnt = 1;
                                                                    if($query->rowCount() > 0)
                                                                    {
                                                                    foreach($results as $result)
                                                                {?>                                            
                                                                <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->CommuneName); ?></option>
                                                                <?php }} ?>
                                                        </select>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="col m6">
                                                    <div class="row">  
                                                        <div class="input-field col s12">
                                                            <input id=" quartname" type="text"  class="validate" autocomplete="off" name="quartname"  required>
                                                            <label for="quartname">Nom du quartier</label>
                                                        </div>
                                                        <div class="input-field col s12">
                                                            <button type="submit" name="add" class="waves-effect waves-light btn indigo m-b-xs">Créer</button>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        </section>
                                    </div>
                                </form>
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