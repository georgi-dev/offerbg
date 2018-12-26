<?php
// global $container;
// include_once(dirname(__DIR__) . '/head.php');
// include_once(dirname(__DIR__) . '/header.php');

?>
<?php
  $headerParams = array('SiteTitle' => "Всички фирми");
?>
<?php $this->load->view('header',$headerParams)?>
<div class="container mt-4">
    <div class="row">
        <div class="col-12 col-sm-4 col-md-3">
            <?php
            //include_once(__DIR__ . '/sidebar.php');
            ?>
        </div>
        <div class="col-12 col-sm-8 col-md-9">
            <h1>Фирми</h1>
            <div class="input-group my-4">
                <input type="text" id="txtFilter" class="form-control" placeholder="Name, Description, ...">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" id="btnFilter">Търсене</button>
                </div>
            </div>
            <table class="table" id="tblFirms">
                <thead>
                    <tr>
                        
<th><div class="th">Id</div></th>
<th><div class="th">EIK</div></th>
<th><div class="th">Name</div></th>
<th><div class="th">Description</div></th>
<th><div class="th">Address</div></th>
<th><div class="th">Activities</div></th>
<th><div class="th">Verified</div></th>
<th><div class="th">Vat</div></th>
<th><div class="th">Created</div></th>
                        <th>#</th>
                    </tr>
                </thead>
            <tbody></tbody>
        </table>
        
        <input type="hidden" id="hddnPage" value="1" />
        <nav class="row">
            <div class="col-md-8">
                <div class="input-group">
                    <a href="/Firms/add_firm" class="btn btn-primary">Добави нова фирма</a>
                    <!-- <div class="input-group-append">
                        <span class="show_entries px-4">Showing <span id="fromEntry">1</span> to <span id="toEntry">10</span> of <span id="totalEntries"></span> entries</span>
                    </div> -->
                    
                </div>
                
            
            </div>
            <div class="col-md-4"><ul class="pagination float-right"></ul></div>
        </nav>
    
    
</div>
</div>
</div>
<script src="/assets/js/firms.js"></script>


<?php $this->load->view('footer');?>
<script>
    jQuery(function() {
        Firms.getAll();
        $('#btnFilter').on('click',function(){
            
            Firms.getAll();
        })
    });
</script>
<?php
// include_once(dirname(__DIR__) . '/foot.php');
?>
