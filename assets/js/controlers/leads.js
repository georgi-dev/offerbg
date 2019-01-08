var Ads =
{
    getAll: function(params)
    {   


        console.log("DWADAWD");
        var page = params && params.page ? params.page : 1;
        var filter = params && params.filter ? params.filter : $.trim($("#txtFilter").val());
        var sort = params && params.sort  ? params.sort : 'id';
        var sortorder = params && params.sortorder ? params.sortorder : 'DESC';
        $("#hddnPage").val(page);
        // console.log(page);

        // return false;
        API.get("/Ads/get_all", {}, {
            page: page,
            filter: filter
            // sort : sort,
            // sortorder : sortorder
        }, function(response) {
            var tblSrc = "", ulSrc = "", i;
            for(i = 0;i < response.ads.length;i++) {
              
                tblSrc += "<tr>";
                 // Proverka dali e active. Ako ne e - reda e zasiven
        console.log("response",response);
                var point = "";
               // if (response.ads[i].city != "" && response.ads[i].address != "") {
               //  point = ", ";
               // }

		tblSrc += "<td>" + (response.ads[i].ad_id || "") + "</td>"
		tblSrc += "<td>" + (response.ads[i].creator || "") + "</td>"
		tblSrc += "<td>" + (response.ads[i].title || "") + "</td>"
        tblSrc += "<td>" + (response.ads[i].ad_desc || "") + "</td>"
         console.log("files",typeof(response.ads[i].files));
         console.log("files", JSON.parse(response.ads[i].files));


         // return false;
        var files = [];
        tblSrc += "<td>";
        $.each(JSON.parse(response.ads[i].files), function(index, value) {

           console.log(value);
            $.each(response.uploaded_files,function(index1,value1) {
                if (value == value1.file_id) {
                    console.log(value1.file_name);
                    tblSrc  += `<div>
                                    <div class="card" style="width: 10rem;">
                                      <img class="card-img-top img-thumbnail" src="/upldocs/${value1.file_name}" alt="Card image cap">
                                      <div class="card-body">
                                        <h5 class="card-title">${value1.file_name}</h5>
                                        <a href="/upldocs/${value1.file_name}" class="btn btn-primary" download>Download</a>
                                      </div>
                                    </div>
                                </div>


                        `;
                }
            });
        });
		tblSrc  += "</td>";
		tblSrc += "<td>" + (response.ads[i].type || "") + "</td>"
		tblSrc += "<td>" + (response.ads[i].created || "") + "</td>"
		tblSrc += "<td>" + (response.ads[i].date_valid || "") + "</td>"
                tblSrc += "<td>";
                tblSrc += "<a href=\"/Ads/ad/" + response.ads[i].ad_id + "\" class=\"fa fa-edit\"></a>";
                tblSrc += "&nbsp;<a href=\"javascript:Ads.remove(" + response.ads[i].ad_id + ");\" class=\"fa fa-trash text-danger\"></a>";
                tblSrc += "</td>";
                tblSrc += "</tr>";
            }
            
            jQuery("#tblAds tbody").html(tblSrc);

             for (i = Math.max(1, $("#hddnPage").val() - 2);i <= Math.max(response.pages, Math.min(response.pages, parseInt($("#hddnPage").val()) + 2));i++) {
            ulSrc += "<li class=\"page-item " + (i == $("#hddnPage").val() ? "active" : "") + "\"><a class=\"page-link\"href=\"javascript:Ads.getAll({page:" + i + "})\">" + i + "</a></li>";
            }
            
            $(".pagination").html(ulSrc);
        },function(err){
            console.log(err);
        });

    },

    getOne: function(field_id)
    {
        $.getJSON(mainUrl + "includes/receiver.php?req=get_one&field_id=" + field_id, function(response) {

$("#field_id").val(response.field_id);
$("#field_EIK").val(response.field_EIK);
$("#field_name").val(response.field_name);
$("#field_description").val(response.field_description);
$("#field_verified").val(response.field_verified);
$("#field_vat").val(response.field_vat);
$("#field_created").val(response.field_created);
        });
    },

    add: function()
    {   

       

       var unindexed_array = $("#frmAds").serializeArray();
        var activities = $('.activities').val();
            // $.each(activities, function(name, value){

            //     console.log(activities);
            // });
            // // console.log(indexed_array);
                unindexed_array.push({name: 'activities', value: activities});
            var indexed_array = {};
            //return false;

            $.map(unindexed_array, function(n, i){
                indexed_array[n['name']] = n['value'];
            });

            //indexed_array.push(activities);
           
console.log(indexed_array);

            //return false;
        API.post("/Ads/add_add", {}, indexed_array, function(response) {
            console.log("response",response);
            General.showModal("Фирмата беше добавена!", function() {
                window.location.href = "/ads";
            }, false);
            //alert("ads was added!");
        });
    },
    
    update: function()
    {
        var unindexed_array = $("#frmAds").serializeArray();
        var activities = $('.activities').val();
            // $.each(activities, function(name, value){

            //     console.log(activities);
            // });
            // // console.log(indexed_array);
                unindexed_array.push({name: 'activities', value: activities});
            var indexed_array = {};

            $.map(unindexed_array, function(n, i){
                indexed_array[n['name']] = n['value'];
            });

            
            
            console.log(indexed_array);
            //return false;
        API.post("/Ads/edit_ad", {}, indexed_array, function(response) {
            General.showModal("Фирмата беше редактирана!", function() {
                window.location.href = "/ads";
            }, false);
        },function(err){
            console.log(err);
        });
    },

    remove: function(field_id)
    {
        // if (confirm("Are you sure you want to delete this record")) {
        //     $.getJSON(mainUrl + "includes/receiver.php?req=remove&field_id=" + field_id, function (response) {
        //         alert("Record deleted");
        //         ads.get({page:1});
        //     });
        // }

        General.showModal("Are you sure you want to delete this record?", function() {
            API.post("/Ads/delete_one", {}, {"id": field_id}, function(response) {
                General.showModal("Фирмата беше изтрита!", function() {
                    window.location.href = "/ads";
                }, false);
            },function(err) {
                console.log(err);
            });
        });
    }
}
