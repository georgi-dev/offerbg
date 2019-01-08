var Dashboard = {
	getCount: function() {

		API.get("/Dashboard/getcount", {}, {
			
		}, function(response) {

			console.log(response);

			//return false;
			var data = response;
			
			$('.count-users').text(data.count.users_cnt);
			//$('.count-cities').text(data.count.cities_cnt);
			$('.count-ads').text(data.count.ads_cnt);
			$('.count-firms').text(data.count.firms_cnt);
			$('.count-offers').text(data.count.offers_cnt);
			// $('.count-messages').text(data.count.messages_cnt);
			$('.count-deals').text(data.count.deals_cnt);
			// $('.count-feedback').text(data.count.feedback_cnt);
		});
	}
}