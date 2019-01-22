<?php
// global $container;
// include_once(dirname(__DIR__) . '/head.php');
// include_once(dirname(__DIR__) . '/header.php');

?>
<?php
  $headerParams = array('SiteTitle' => "Всички оферти");
?>
<?php $this->load->view('elements/head',$headerParams)?>
<main>
    <section class="container mt-4">
        <div class="row">
            <div class="col-12 col-sm-4 col-md-3">
                <?php
                $this->load->view("_admin/sidebar");
                ?>
            </div>
        
        <div class="col-12 col-sm-8 col-md-9">
            <h1>Оферти</h1>
            <div class="input-group my-4">
                <input type="text" id="txtFilter" class="form-control" placeholder="Name, Description, ...">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" id="btnFilter">Търсене</button>
                </div>
            </div>
            <table class="table" id="tblOffers">
                <thead>
                    <tr>
                        
<th><div class="th">Id</div></th>
<th><div class="th">FirmID</div></th>
<th><div class="th">AdsID</div></th>
<th><div class="th">Description</div></th>
<th><div class="th">Price</div></th>
<th><div class="th">Files</div></th>
<th><div class="th">Сертификати</div></th>
<th><div class="th">Delivery time</div></th>
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
                    <a href="/Offers/add_offer" class="btn btn-primary">Добави нова оферта</a>
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
</section>
</main>
<script src="/assets/js/offers.js"></script>


<?php $this->load->view('elements/foot');?>
<script>
    jQuery(function() {
        Offers.getAll();
        $('#btnFilter').on('click',function(){
            
            Offers.getAll();
        })
    });
</script>
<?php
// include_once(dirname(__DIR__) . '/foot.php');
?>
