<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin']) == 0)
{   
header('location:index.php');
}else{
?><!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Title -->
        <title>Admin | Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">    
        <link href="../assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet">
        <link href="../assets/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet">
        <!-- Theme Styles -->
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
        
    </head>
    <body>
    <?php include('includes/header.php');?>    
       <?php include('includes/sidebar.php');?>
            <main class="mn-inner">
                <div class="middle-content">
                    <div class="row no-m-t no-m-b">
                    <div class="col s12 m12 l4">
                        <div class="card stats-card">
                            <div class="card-content">
                                <span class="card-title">Total des agents enregistrés</span>
                                <span class="stats-counter">
                                <?php
                                    $sql = "SELECT id from tagent";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $agcount = $query->rowCount();
                                ?>
                                <span class="counter"><?php echo htmlentities($agcount); ?></span></span>
                            </div>
                            <div id="sparkline-bar"></div>
                        </div>
                    </div>
                        <div class="col s12 m12 l4">
                        <div class="card stats-card">
                            <div class="card-content">                          
                                <span class="card-title">Liste des centres</span>
                                    <?php
                                        $sql = "SELECT id from tcentre";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $centcount = $query->rowCount();
                                    ?>                            
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($centcount); ?></span></span>
                            </div>
                            <div id="sparkline-line"></div>
                        </div>
                    </div>
                    <div class="col s12 m12 l4">
                        <div class="card stats-card">
                            <div class="card-content">
                                <span class="card-title">Liste de type d'agréement</span>
                                    <?php
                                        $sql = "SELECT id from  tagreetype";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $agrtypcount=$query->rowCount();
                                    ?>   
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($agrtypcount); ?></span></span>
                            </div>
                            <div class="progress stats-card-progress">
                                <div class="determinate" style="width: 70%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="row no-m-t no-m-b">
                        <div class="col s12 m12 l12">
                            <div class="card invoices-card">
                                <div class="card-content"> 
                                    <span class="card-title">Dernières applications d'agréement</span>
                                        <table id="example" class="display responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th width="200">Nom de l'agent</th>
                                                    <th width="120">Grade</th>
                                                    <th width="180">Poster en date</th>                 
                                                    <th>Status</th>
                                                    <th align="center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $sql = "SELECT tdetails.id as tid,tagent.FirstName,tagent.LastName,tagent.AgId,tagent.id,tdetails.AgrType,tdetails.PostingDate,tdetails.Status from tdetails join tagent on tdetails.agid=tagent.id order by tid desc limit 6";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if($query->rowCount() > 0)
                                                {
                                                foreach($results as $result)
                                            {?>  
                                        <tr>
                                            <td><b><?php echo htmlentities($cnt); ?></b></td>
                                            <td><a href="editagent.php?agid=<?php echo htmlentities($result->id); ?>" target="_blank"><?php echo htmlentities($result->FirstName." ".$result->LastName); ?>(<?php echo htmlentities($result->AgId); ?>)</a></td>
                                            <td><?php echo htmlentities($result->AgrType); ?></td>
                                            <td><?php echo htmlentities($result->PostingDate); ?></td>
                                            <td><?php $stats = $result->Status;
                                             if($stats == 1){
                                             ?>
                                                <span style="color: green">Agrée</span>
                                                <?php } if($stats == 2)  { ?>
                                                <span style="color: red">Non agrée</span>
                                                 <?php } if($stats == 0)  { ?>
                                                <span style="color: blue">En attente</span>
                                                <?php } ?>
                                             </td>
                                            <td>
                                            <td><a href="agree-details.php?agrid=<?php echo htmlentities($result->tid);?>" class="waves-effect waves-light btn blue m-b-xs"> View Details</a></td>
                                        </tr>
                                         <?php $cnt++; }}?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="../assets/plugins/counter-up-master/jquery.counterup.min.js"></script>
        <script src="../assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="../assets/plugins/chart.js/chart.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="../assets/plugins/curvedlines/curvedLines.js"></script>
        <script src="../assets/plugins/peity/jquery.peity.min.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/dashboard.js"></script>
    </body>
</html>
<?php } ?>