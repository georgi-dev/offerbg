var Firms =
{
    getAll: function(params)
    {
        var page = params && params.page ? params.page : 1;
        var filter = params && params.filter ? params.filter : $.trim($("#txtFilter").val());
        var sort = params && params.sort  ? params.sort : 'id';
        var sortorder = params && params.sortorder ? params.sortorder : 'DESC';
        $("#hddnPage").val(page);
        API.get("/Firms/get_all", {}, {
            page: page,
            filter: filter
            // sort : sort,
            // sortorder : sortorder
        }, function(response) {
            var tblSrc = "", ulSrc = "", i;
            for(i = 0;i < response.firms.length;i++) {
              
                tblSrc += "<tr>";
                 // Proverka dali e active. Ako ne e - reda e zasiven
        console.log(response);

               
		tblSrc += "<td>" + (response.firms[i].id || "") + "</td>"
		tblSrc += "<td>" + (response.firms[i].EIK || "") + "</td>"
		tblSrc += "<td>" + (response.firms[i].name || "") + "</td>"
		tblSrc += "<td>" + (response.firms[i].description || "") + "</td>"
		tblSrc += "<td>" + (response.firms[i].verified || "") + "</td>"
		tblSrc += "<td>" + (response.firms[i].vat || "") + "</td>"
		tblSrc += "<td>" + (response.firms[i].created || "") + "</td>"
                tblSrc += "<td>";
                tblSrc += "<a href=\"/Firms/firm/" + response.firms[i].id + "\" class=\"fa fa-edit\"></a>";
                tblSrc += "&nbsp;<a href=\"javascript:Firms.remove(" + response.firms[i].id + ");\" class=\"fa fa-trash text-danger\"></a>";
                tblSrc += "</td>";
                tblSrc += "</tr>";
            }
            
            jQuery("#tblFirms tbody").html(tblSrc);

             for (i = Math.max(1, $("#hddnPage").val() - 2);i <= Math.max(response.pages, Math.min(response.pages, parseInt($("#hddnPage").val()) + 2));i++) {
            ulSrc += "<li class=\"page-item " + (i == $("#hddnPage").val() ? "active" : "") + "\"><a class=\"page-link\"href=\"javascript:Firms.getAll({page:" + i + "})\">" + i + "</a></li>";
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
       var unindexed_array = $("#frmFirms").serializeArray();
            var indexed_array = {};

            $.map(unindexed_array, function(n, i){
                indexed_array[n['name']] = n['value'];
            });

            
            
            console.log(indexed_array);
            //return false;
        API.post("add_firm", {}, indexed_array, function(response) {
            console.log("response",response);
            General.showModal("Фирмата беше добавена!", function() {
                window.location.href = "/firms";
            }, false);
            //alert("firms was added!");
        });
    },
    
    update: function()
    {
        var unindexed_array = $("#frmFirms").serializeArray();
            var indexed_array = {};

            $.map(unindexed_array, function(n, i){
                indexed_array[n['name']] = n['value'];
            });

            
            
            console.log(indexed_array);

        API.post("/Firms/edit_firm", {}, indexed_array, function(response) {
            General.showModal("Фирмата беше редактирана!", function() {
                window.location.href = "/firms";
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
        //         Firms.get({page:1});
        //     });
        // }

        General.showModal("Are you sure you want to delete this record?", function() {
            API.post("/Firms/delete_one", {}, {"id": field_id}, function(response) {
                General.showModal("Фирмата беше изтрита!", function() {
                    window.location.href = "/firms";
                }, false);
            },function(err) {
                console.log(err);
            });
        });
    }
}
