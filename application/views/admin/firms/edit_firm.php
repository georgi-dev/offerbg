<?php
// global $container;

// include_once(dirname(__DIR__) . '/head.php');
// include_once(dirname(__DIR__) . '/header.php');

 //print_r($firm);
 $firm = json_decode(json_encode($firm), true);
 //print_r($firm);

 // die();
?>
<?php
  $headerParams = array('SiteTitle' => "Редакция на фирма");
?>
<?php $this->load->view('header',$headerParams)?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12 col-sm-4 col-md-3">
<?php
   // include_once(__DIR__ . '/sidebar.php');
?>
            </div>
            <div class="col-12 col-sm-8 col-md-9">
                <h1>Редакция на - <?php echo $firm["name"];?></h1>
                
                <br /><br />
                <form class="form-horizontal" id="frmFirms">
                    <fieldset>
                                            <input type="hidden" class="form-control" name="id" 
                    value="<?php echo $firm["id"]; ?> "
                    />
                    <div class="form-group">
                        <label for="EIK" class="col-md-2 control-label">EIK</label>
                        <div class="col-md-5 col-sm-4">
                            <input type="text" class="form-control"  name="EIK" 
                            value="<?php echo $firm["EIK"]; ?> "/>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">Name</label>
                        <div class="col-md-5 col-sm-4">
                            <input type="text" class="form-control"  name="name" 
                            value="<?php echo $firm["name"]; ?> "/>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-md-2 control-label">Description</label>
                        <div class="col-md-5 col-sm-4">
                            <input type="text" class="form-control" name="description" 
                            value="<?php echo $firm["description"]; ?> "/>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="verified" class="col-md-2 control-label">Verified</label>
                        <div class="col-md-5 col-sm-4">
                            <select class="form-control" name="verified">
                                <option value="yes" <?php if ($firm["verified"] == "yes"): ?> selected <?php endif ?>>yes</option>
                                <option value="no" <?php if ($firm["verified"] == "no"): ?> selected <?php endif ?>>no</option>                            
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="vat" class="col-md-2 control-label">Vat</label>
                        <div class="col-md-5 col-sm-4">
                           
                            <select class="form-control" name="vat">
                                <option value="yes" <?php if ($firm["vat"] == "yes"): ?> selected <?php endif ?>>yes</option>
                                <option value="no" <?php if ($firm["vat"] == "no"): ?> selected <?php endif ?>>no</option>                           
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="created" class="col-md-2 control-label">Created</label>
                        <div class="col-md-5 col-sm-4">
                            <input type="text" class="form-control" readonly name="created" 
                            value="<?php echo $firm["created"]; ?> "/>

                        </div>
                    </div>

                    </fieldset>
                    
                    <hr />
                    
                    <button type="button" class="btn btn-primary" onclick="Firms.update();">Запази</button>
                    &nbsp;&nbsp;&nbsp;<a href="/firms" class="btn btn-link">Отказ</a>
                </form>
            </div>
        </div>
    </div>
    <script src="/assets/js/firms.js"></script>

<?php $this->load->view('footer');?>
<?php
// include_once(dirname(__DIR__) . '/foot.php');
?>