<?php
  $headerParams = array('SiteTitle' => "Добавяне на фирма");
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
                <h1>Добави фирма</h1>
                
                <br /><br />
                <form class="form-horizontal" id="frmFirms">
                    <fieldset>
                                            <div class="form-group">
                        <label for="EIK" class="col-md-2 control-label">EIK</label>
                        <div class="col-md-5 col-sm-4">
                            <input type="text" class="form-control" name="EIK" />

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">Name</label>
                        <div class="col-md-5 col-sm-4">
                            <input type="text" class="form-control" name="name" />

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-md-2 control-label">Description</label>
                        <div class="col-md-5 col-sm-4">
                            <input type="text" class="form-control" name="description" />

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="verified" class="col-md-2 control-label">Verified</label>
                        <div class="col-md-5 col-sm-4">
                            <select class="form-control" name="verified">
                                <option value="yes">yes</option>
                                <option value="no">no</option>                           
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="vat" class="col-md-2 control-label">Vat</label>
                        <div class="col-md-5 col-sm-4">
                            <select class="form-control" name="vat">
                                <option value="yes">yes</option>
                                <option value="no">no</option>                            
                            </select>
                        </div>
                       
                    </div>
                    

                    </fieldset>
                    
                    <hr />
                    
                    <button type="button" class="btn btn-primary" onclick="Firms.add();">Запази</button>
                    &nbsp;&nbsp;&nbsp;<a href="/firms" class="btn btn-link">Отказ</a>
                </form>
            </div>
        </div>
    </div>
    <?php $this->load->view('footer');?>

    <script src="/assets/js/firms.js"></script>



