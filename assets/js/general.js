var General = {
	setCookie: function(name, value, days) {
		if(days) {
			var date = new Date();
			date.setTime(date.getTime() +(days * 24 * 60 * 60 * 1000));
			var expires = "; expires=" + date.toGMTString();
		} else {
			var expires = "";
		}
		document.cookie = name + "=" + value + expires + ";domain=." + applicationDomain + ";path=/";
	},

	getCookie: function(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(";");
		for(var i = 0;i < ca.length;i++) {
			var c = ca[i];
			while(c.charAt(0) == " ") {
				c = c.substring(1, c.length);
			}
			if(c.indexOf(nameEQ) == 0) {
				return c.substring(nameEQ.length, c.length);
			}
		}
		return null;
	},

	deleteCookie: function(name) {
		General.setCookie(name, "", -1);
	},

	parseURI: function(scheme, pathKeys) {
		var uriObj = new URL(scheme);

		var uri = {
			"protocol": uriObj.protocol.replace(":", ""),
			"host": uriObj.hostname,
			"port": uriObj.port || 80,
			"pathname": uriObj.pathname,
			"search": uriObj.search.replace("?", ""),
			"anchor": uriObj.hash.replace("#", ""),
			"query": []
		};
		var pathKeysArray = pathKeys.split("/");
		uri.pathname.split("/").map((value, ndx) => {
			uri[pathKeysArray[ndx] || ""] = value;
		});
		
		uri.search.split("&").map((chunk) => {
			var queryParts = chunk.split("=");
			uri.query[queryParts[0]] = queryParts[1];
		});

		return uri;
	},
	
	showModal: function(content, proceed, cancel) {
		jQuery("#header_modal .modal-body").html(content);
		
		if(proceed && proceed !== false) {
			jQuery("#header_modal #proceed").on("click", proceed);
		}
		
		if(proceed === false) {
			jQuery("#header_modal").modal("hide");
		}		
		
		if(cancel && cancel !== false) {
			jQuery("#header_modal #cancel_action").on("click", cancel);
		}
		
		if(cancel === false) {
			jQuery("#header_modal #cancel_action").addClass("d-none");
		}
		
		jQuery("#header_modal").modal();
	}
};
