var Firms = {
    getAll: function(params) {
        var page = params && params.page ? params.page : 1;
        var filter = params && params.filter ? params.filter : $.trim($("#txtFilter").val());
        var sort = params && params.sort ? params.sort : 'id';
        var sortorder = params && params.sortorder ? params.sortorder : 'DESC';
        $("#hddnPage").val(page);
        API.get("/Firms/get_all", {}, {
            page: page,
            filter: filter
            // sort : sort,
            // sortorder : sortorder
        }, function(response) {
            var tblSrc = "",
                ulSrc = "",
                i;
            for (i = 0; i < response.firms.length; i++) {

                tblSrc += "<tr>";
                // Proverka dali e active. Ako ne e - reda e zasiven
                console.log("response", response);
                var point = "";
                if (response.firms[i].city != "" && response.firms[i].address != "") {
                    point = ", ";
                }
                tblSrc += "<td>" + (response.firms[i].firm_id || "") + "</td>"
                tblSrc += "<td>" + (response.firms[i].firm_EIK || "") + "</td>"
                tblSrc += "<td>" + (response.firms[i].firm_name || "") + "</td>"
                tblSrc += "<td>" + (response.firms[i].firm_desc || "") + "</td>"
                tblSrc += "<td><b>" + (response.firms[i].city || "") + "</b>" + point + (response.firms[i].address || "") + "</td>";
                // console.log("activities",typeof(response.firms[i].activities));
                var activities = [];
                tblSrc += "<td>";
                $.each(JSON.parse(response.firms[i].activities), function(index, value) {

                    //console.log(value);
                    $.each(response.activities, function(index1, value1) {
                        if (value == value1.id) {
                            console.log(value1.name);
                            tblSrc += "<div><b>" + value1.code + "</b>. " + value1.name + "</div>";
                        }
                    });
                });
                tblSrc += "</td>"
                tblSrc += "<td>" + (response.firms[i].certificates || "") + "</td>"

                tblSrc += "<td>" + (response.firms[i].verified || "") + "</td>"
                tblSrc += "<td>" + (response.firms[i].vat || "") + "</td>"
                tblSrc += "<td>" + (response.firms[i].firm_created || "") + "</td>"
                tblSrc += "<td>";
                tblSrc += "<a href=\"/Firms/edit/" + response.firms[i].firm_id + "\" class=\"fa fa-edit\"></a>";
                tblSrc += "&nbsp;<a href=\"javascript:Firms.remove(" + response.firms[i].firm_id + ");\" class=\"fa fa-trash text-danger\"></a>";
                tblSrc += "</td>";
                tblSrc += "</tr>";
            }

            jQuery("#tblFirms tbody").html(tblSrc);

            for (i = Math.max(1, $("#hddnPage").val() - 2); i <= Math.max(response.pages, Math.min(response.pages, parseInt($("#hddnPage").val()) + 2)); i++) {
                ulSrc += "<li class=\"page-item " + (i == $("#hddnPage").val() ? "active" : "") + "\"><a class=\"page-link\"href=\"javascript:Firms.getAll({page:" + i + "})\">" + i + "</a></li>";
            }

            $(".pagination").html(ulSrc);
        }, function(err) {
            console.log(err);
        });

    },

    getOne: function(field_id) {
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

    add: function() {

        var unindexed_array = $("#frmFirms").serializeArray();
        var activities = $('.activities').val();
        // $.each(activities, function(name, value){
        var cnt_cities = $(document).find('select[name="city"]').length;
        var cities = [];
        var addressess = [];
        for (var i = 0; i < cnt_cities; i++) {

            console.log($(document).find('select[name="city"]').eq(i).val());
            cities.push($(document).find('select[name="city"]').eq(i).val());
            addressess.push($(document).find('textarea[name="address"]').eq(i).val());
        }

        var cnt_certificates = $('input[name^="certificates"]').length;
        var certificates = [];

        for (var i = 0; i < cnt_certificates; i++) {
            //console.log($(document).find('select[name="city"]').eq(i).val());
            certificates.push($(document).find('input[name^="certificates"]').eq(i).val());

        }

        unindexed_array.push({
            name: 'activities',
            value: activities
        });
        unindexed_array.push({
            name: 'cities',
            value: cities
        });
        unindexed_array.push({
            name: 'addressess',
            value: addressess
        });
        unindexed_array.push({
            name: 'certificates',
            value: certificates
        });
        var indexed_array = {};
        //return false;

        $.map(unindexed_array, function(n, i) {
            indexed_array[n['name']] = n['value'];
        });

        // console.log(indexed_array);

        // return false;
        API.post("/Firms/add_firm", {}, indexed_array, function(response) {
            console.log("response", response);
            General.showModal("Фирмата беше добавена!", function() {
                window.location.href = "/firms";
            }, false);
            //alert("firms was added!");
        });
    },

    update: function() {
        var unindexed_array = $("#frmFirms").serializeArray();
        var activities = $('.activities').val();
        // $.each(activities, function(name, value){

        //     console.log(activities);
        // });
        // // console.log(indexed_array);
        unindexed_array.push({
            name: 'activities',
            value: activities
        });
        var indexed_array = {};

        $.map(unindexed_array, function(n, i) {
            indexed_array[n['name']] = n['value'];
        });



        console.log(indexed_array);
        //return false;
        API.post("/Firms/edit_firm", {}, indexed_array, function(response) {
            General.showModal("Фирмата беше редактирана!", function() {
                window.location.href = "/firms";
            }, false);
        }, function(err) {
            console.log(err);
        });
    },

    remove: function(field_id) {
        // if (confirm("Are you sure you want to delete this record")) {
        //     $.getJSON(mainUrl + "includes/receiver.php?req=remove&field_id=" + field_id, function (response) {
        //         alert("Record deleted");
        //         Firms.get({page:1});
        //     });
        // }

        General.showModal("Are you sure you want to delete this record?", function() {
            API.post("/Firms/delete_one", {}, {
                "id": field_id
            }, function(response) {
                General.showModal("Фирмата беше изтрита!", function() {
                    window.location.href = "/firms";
                }, false);
            }, function(err) {
                console.log(err);
            });
        });
    }
}