function rolesByApp(localUrl, nit, id){
	var comboHead = '', comboOptions='', comboEnd='', combos='', values, labelApp='';
	var userApp   = document.getElementById('userApps'+id);

	//aquí tu código
	var url    = userApp.getAttribute('data-link');
	var app_id = userApp.value;
	var app    = userApp.getAttribute('data-app');

	if (userApp.checked==true) {
       	$.ajaxSetup({
          	headers: {
          		// 'Accept':'application/json',
              	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          	}
      	});

       	$.ajax({
			url    : localUrl,
			method : 'GET',
			data   :
			{
				app   :app,
				nit   :nit,
				url   :url,
				table :0,
          	},
          	success: function(result){
				var obj  = JSON.parse(result);
				labelApp = app;
				console.dir(obj.response);
				if(!document.getElementById('divRolByApp'+id)){
					div = document.createElement('div');
					div.id = "divRolByApp"+id;
					document.getElementById('rolByApp').appendChild(div);
				}
				if(obj.response==false){
					// $('#divRolByApp'+id).html(labelApp+': Al ser un usuario de soporte, automaticamente queda con un rol de soporte asigando.')
					return;
				}
				comboHead ='<div class="input-group mb-3" id="divApp'+app_id+'"><select name="rolesApp[]" id="" class="form-control">';
				for (var i = 0; i < obj.length; i++) {
					comboOptions+='<option value="'+obj[i].id+'">'+obj[i].nombre+'</option>';
				}
				comboEnd ='</select>';
				combos   +='<div class="input-group mb-3">'+comboHead+comboOptions+comboEnd+'<div class="input-group-append-sm" aria-label="Small"><label for="" class="input-group-text">'+labelApp+'</label></div></div></div>';


				$('#divRolByApp'+id).html(combos)
				combos = ''; comboHead=''; comboOptions=''; comboEnd='';
          	}});
	}else{
		$('#divRolByApp'+id).html('')
	}
}

function getDepartmentsByCountry(urlDepartments, urlCities)
{
	$.ajaxSetup({
	          	headers: {
	          		// 'Accept':'application/json',
	              	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	          	}
	      	});

	var head = '<select class="form-control" required name="stateOrigin" id="stateOrigin" onchange="getCitiesByDepartment(\''+urlCities+'\')">';
	$('#divStateOrigin').html(head+'<option value="0">Seleccione...</option></select>')

	$('#divCityOrigin').html('<select class="form-control" required name="cityOrigin" id="cityOrigin">'+head+'<option value="0">Seleccione...</option>'+'</select>')

	$.ajax({
			url    : urlDepartments,
			method : 'GET',
			data   :
			{
				id : $( "#countryOrigin" ).val(),
          	},
          	success: function(result){
				var obj    = JSON.parse(result);
				var option ='';
          		for (var i = 0; i < obj.length; i++) {
          			option += '<option value="'+obj[i].id+'">'+obj[i].description+'</option>';
				}
				$('#divStateOrigin').html(head+option+'</select>')

          	}

		});
}

function getCitiesByDepartment(url)
{
	$.ajaxSetup({
	          	headers: {
	          		// 'Accept':'application/json',
	              	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	          	}
	      	});

	$.ajax({
			url    : url,
			method : 'GET',
			data   :
			{
				id : $( "#stateOrigin" ).val(),
          	},
          	success: function(result){
				var obj    = JSON.parse(result);
				var head   ='<select class="form-control" required name="cityOrigin" id="cityOrigin">';
				var option ='';
          		for (var i = 0; i < obj.length; i++) {
          			option += '<option value="'+obj[i].id+'">'+obj[i].description+'</option>';
				}
				$('#divCityOrigin').html(head+option+'</select>')

          	}

		});
}

