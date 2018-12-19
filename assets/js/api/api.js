var API = {
	get: function(class_and_method, headers, data, success, fail) {

		var url = class_and_method;
		
		// if(data) {
		// 	url += "?" + Object.keys(data).map(function(k) {
		// 		return encodeURIComponent(k) + "=" + encodeURIComponent(data[k]);
		// 	}).join("&");
		// }
		console.log(url);
		$.ajax({
	            type: "POST",
	            url: class_and_method,
	            dataType: 'json',
	            data: {}
		                
		      }).
		      done(function(response){
		        success(response);
		      
		      })
		      .fail(function(err){
		        fail(err);
		      });
		// $.ajax('https://offerbg.localhost/'+url, {
		// 		headers: {
		// 			headers
		// 		}			
		// }).then(response => response.json()
		// ).then((data) => {
		// 	success(data);
		// }).catch(function(error) {
		// 	console.log("There was an error!");
			
		// 	if(fail) {
		// 		fail(error);
		// 	}
		// });
	},

	post: function(class_and_method, headers, data, success, fail) {
		var url = class_and_method;
			
		$.ajax({
	            type: "POST",
	            url: class_and_method,
	            dataType: 'json',
	            data: {}
		                
		      }).
		      done(function(response){
		        success(response);
		      
		      })
		      .fail(function(err){
		        return err;
		      });

		// var postParams = new FormData();
		// for(var key in data) {
		// 	postParams.append(key, data[key]);
		// }
		
		// fetch(url, {
		// 	method: "POST",
		// 	headers: {
		// 		headers
		// 	},
		// 	body: postParams
		// }).then((response) => {
		// 	return response.json();
		// }).then((data) => {
		// 	success(data);
		// }).catch(function(error) {
		// 	console.log("There was an error!");
			
		// 	if(fail) {
		// 		fail(error);
		// 	}			
		// });
	},

	put: function(method, headers, data, success, fail) {
		var url = "/api/" + method;
		
		var postParams = new FormData();
		for(var key in data) {
			postParams.append(key, data[key]);
		}
		
		fetch(url, {
			method: "PUT",
			headers: {
				headers
			},
			body: postParams
		}).then((response) => {
			return response.json();
		}).then((data) => {
			success(data);
		}).catch(function(error) {
			console.log("There was an error!");
			
			if(fail) {
				fail(error);
			}			
		});
	},

	patch: function(method, headers, data, success, fail) {
		var url = "/api/" + method;
		
		var postParams = new FormData();
		for(var key in data) {
			postParams.append(key, data[key]);
		}
		
		fetch(url, {
			method: "PATCH",
			headers: {
				headers
			},
			body: postParams
		}).then((response) => {
			return response.json();
		}).then((data) => {
			success(data);
		}).catch(function(error) {
			console.log("There was an error!");
			
			if(fail) {
				fail(error);
			}			
		});
	},

	remove: function(method, headers, data, success, fail) {
		var url = "/api/" + method;
		
		if(data) {
			url += "?" + Object.keys(data).map(function(k) {
				return encodeURIComponent(k) + "=" + encodeURIComponent(data[k]);
			}).join("&");
		}
		
		fetch(url, {
			method: "DELETE",
			headers: {
				headers
			}
		}).then((response) => {
			return response.json();
		}).then((data) => {
			success(data);
		}).catch(function(error) {
			console.log("There was an error!");
			
			if(fail) {
				fail(error);
			}			
		});
	}
};