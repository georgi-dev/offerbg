<?php
// global $container;
// include_once(dirname(__DIR__) . '/head.php');
// include_once(dirname(__DIR__) . '/header.php');

?>
<?php
  $headerParams = array('SiteTitle' => "Всички Потребители");
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
            <h1>Потребители</h1>
            <div class="input-group my-4">
                <input type="text" id="txtFilter" class="form-control" placeholder="Name, Description, ...">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" id="btnFilter">Търсене</button>
                </div>
            </div>
            <table class="table" id="tblUsers">
                <thead>
                    <tr>
    
<th><div class="th">Id</div></th>
<th><div class="th">Име</div></th>
<th><div class="th">Имейл</div></th>
<th><div class="th">Тип</div></th>
<th><div class="th">Град</div></th>
<th><div class="th">Verified</div></th>
<th><div class="th">Дата на регистрация</div></th>
                        <th>#</th>
                    </tr>
                </thead>
            <tbody></tbody>
        </table>
        
        <input type="hidden" id="hddnPage" value="1" />
        <nav class="row">
            <div class="col-md-8">
               <!--  <div class="input-group">
                    <a href="/Firms/add_firm" class="btn btn-primary">Добави нова фирма</a>
                    
                    
                </div> -->
                
            
            </div>
            <div class="col-md-4"><ul class="pagination float-right"></ul></div>
        </nav>
    
    
</div>
</div>
</div>
</section>
</main>
<script src="/assets/js/users.js"></script>


<?php $this->load->view('foot');?>
<script>
    jQuery(function() {
        Users.getAll();
        $('#btnFilter').on('click',function(){
            
            Users.getAll();
        })
    });
</script>
<?php
// include_once(dirname(__DIR__) . '/foot.php');
?>
