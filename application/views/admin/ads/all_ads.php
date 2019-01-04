<?php
// global $container;
// include_once(dirname(__DIR__) . '/head.php');
// include_once(dirname(__DIR__) . '/header.php');

?>
<?php
  $headerParams = array('SiteTitle' => "Всички Обяви");
?>
<?php $this->load->view('head',$headerParams)?>
<main>
    <section class="container mt-4">
        <div class="row">
            <div class="col-12 col-sm-4 col-md-3">
                <?php
                $this->load->view("admin/sidebar");
                ?>
            </div>
            <div class="col-12 col-sm-8 col-md-9">
                <h1>Обяви</h1>
                <div class="input-group my-4">
                    <input type="text" id="txtFilter" class="form-control" placeholder="Name, Description, ...">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="btnFilter">Търсене</button>
                    </div>
                </div>
                
                <table class="table" id="tblAds">
                    <thead>
                        <tr>
                            
                            <th><div class="th">Id</div></th>
                            <th><div class="th">Creator</div></th>
                            <th><div class="th">Title</div></th>
                            <th><div class="th">Description</div></th>
                            <th><div class="th">Invited firms</div></th>
                            <th><div class="th">Files</div></th>
                            <th><div class="th">Type</div></th>
                            <th><div class="th">Date_valid</div></th>
                            <th><div class="th">Date_create</div></th>
                            <th>#</th>
                        </tr>
                    </thead>
                <tbody></tbody>
            </table>
            
            <input type="hidden" id="hddnPage" value="1" />
            <nav class="row">
                <div class="col-md-8">
                    <div class="input-group">
                        <a href="/Ads/add_ad" class="btn btn-primary">Добави нова обява</a>
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
<script type="text/javascript" src="<?php echo asset_url()?>js/leads.js"></script>

<?php $this->load->view('foot');?>


<script type="text/javascript">
    jQuery(function() {
        Ads.getAll();
        $('#btnFilter').on('click',function(){
            
            Ads.getAll();
        })
    });
</script>
<?php
// include_once(dirname(__DIR__) . '/foot.php');
?>
