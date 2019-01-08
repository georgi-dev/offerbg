var Users =
{
    getAll: function(params)
    {
        var page = params && params.page ? params.page : 1;
        var filter = params && params.filter ? params.filter : $.trim($("#txtFilter").val());
        var sort = params && params.sort  ? params.sort : 'id';
        var sortorder = params && params.sortorder ? params.sortorder : 'DESC';
        $("#hddnPage").val(page);
        API.get("/Users/GetUsers", {}, {
            page: page,
            filter: filter
            // sort : sort,
            // sortorder : sortorder
        }, function(response) {

        console.log("response",response);

        //return false;
            var tblSrc = "", ulSrc = "", i;
            for(i = 0;i < response.users.length;i++) {
              
                tblSrc += "<tr>";
                 // Proverka dali e active. Ako ne e - reda e zasiven
//                 city: null
// fname: "Георги"
// lname: "Иванов"
// user_city_id: null
// user_email: "d1lgiq87@gmail.com"
// user_id: "8"
// user_phone: "0897018017"
// user_registration_date: "2018-12-20 21:27:15"
// user_type: "admin"
// user_verified: "no"

// <th><div class="th">Id</div></th>
// <th><div class="th">first_name</div></th>
// <th><div class="th">last_name</div></th>
// <th><div class="th">email</div></th>
// <th><div class="th">type</div></th>
// <th><div class="th">city_id</div></th>
// <th><div class="th">Verified</div></th>
// <th><div class="th">date_registration</div></th>
        		tblSrc += "<td>" + (response.users[i].user_id || "") + "</td>";
        		tblSrc += "<td>" + (response.users[i].fname + " " + response.users[i].lname) + "</td>";
        		tblSrc += "<td>" + (response.users[i].user_email || "") + "</td>";
                tblSrc += "<td>" + (response.users[i].user_type || "") + "</td>";
                tblSrc += "<td><b>" + (response.users[i].city || "") + "</td>";
                tblSrc += "<td><b>" + (response.users[i].user_verified || "") + "</td>";
                tblSrc += "<td><b>" + (response.users[i].user_registration_date || "") + "</td>";
        // console.log("activities",typeof(response.users[i].activities));
        // var activities = [];
        // tblSrc += "<td>";
        // $.each(JSON.parse(response.users[i].activities), function(index, value){

        //    //console.log(value);
        //     $.each(response.activities,function(index1,value1){
        //         if (value == value1.id) {
        //             console.log(value1.name);
        //             tblSrc  += "<div><b>"+value1.code + "</b>. "+ value1.name+"</div>";
        //         }
        //     });
        // });
		// tblSrc  += "</td>"
		// tblSrc += "<td>" + (response.users[i].verified || "") + "</td>"
		// tblSrc += "<td>" + (response.users[i].vat || "") + "</td>"
		// tblSrc += "<td>" + (response.users[i].firm_created || "") + "</td>"
                tblSrc += "<td>";
                tblSrc += "<a href=\"/Users/edit/" + response.users[i].user_id + "\" class=\"fa fa-edit\"></a>";
                tblSrc += "&nbsp;<a href=\"javascript:Users.remove(" + response.users[i].user_id + ");\" class=\"fa fa-trash text-danger\"></a>";
                tblSrc += "</td>";
                tblSrc += "</tr>";
            }
            
            jQuery("#tblUsers tbody").html(tblSrc);

             for (i = Math.max(1, $("#hddnPage").val() - 2);i <= Math.max(response.pages, Math.min(response.pages, parseInt($("#hddnPage").val()) + 2));i++) {
            ulSrc += "<li class=\"page-item " + (i == $("#hddnPage").val() ? "active" : "") + "\"><a class=\"page-link\"href=\"javascript:Users.getAll({page:" + i + "})\">" + i + "</a></li>";
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
    
    update: function()
    {
        var unindexed_array = $("#frmUsers").serializeArray();
        //var activities = $('.activities').val();
            // $.each(activities, function(name, value){

            //     console.log(activities);
            // });
            // // console.log(indexed_array);
                //unindexed_array.push({name: 'activities', value: activities});
            var indexed_array = {};

            $.map(unindexed_array, function(n, i){
                indexed_array[n['name']] = n['value'];
            });

            
            
            console.log(indexed_array);
            //return false;
        API.post("/Users/edit_user", {}, indexed_array, function(response) {
            General.showModal("Потребителя беше редактиран!", function() {
                window.location.href = "/users";
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
        //         users.get({page:1});
        //     });
        // }

        General.showModal("Are you sure you want to delete this record?", function() {
            API.post("/Users/delete_one", {}, {"id": field_id}, function(response) {
                General.showModal("Потребителят беше изтрит!", function() {
                    window.location.href = "/users";
                }, false);
            },function(err) {
                console.log(err);
            });
        });
    }
}
