<?php
    require 'models/function.php';
    include 'models/m_data_mahasiswa.php';
    $mhs = new dataMahasiswa($connection);
?>

<link rel="stylesheet" type="text/css" href="css/home.css">

<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard <small>Admin</small></h1>
                </div>
                <!-- /.col-lg-12 -->
</div><!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fas fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        <?php
                                            $jml_mhs = count(query("SELECT * FROM tb_data"));
                                            echo $jml_mhs;
                                        ?>
                                    </div>
                                    <div>Data Jumlah Maba</div>
                                </div>
                            </div>
                        </div>
                        <a href="?page=data_mahasiswa">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div> 
            </div>
            