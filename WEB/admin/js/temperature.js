$(document).ready(function(){

	var productList;

	function getProducts(){
		$.ajax({
			url : '../admin/classes/Temperature.php',
			method : 'POST',
			data : {GET_PRODUCT:1},
			success : function(response){
				//console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {

					var productHTML = '';

					productList = resp.message.capteurs;

					if (productList) {
						$.each(resp.message.capteurs, function(index, value){

							productHTML += '<tr>'+
								              '<td>'+''+'</td>'+
								              '<td>'+ value.nom_capteur +'</td>'+
								              '<td><img width="60" height="60" src="../product_images/'+value.image_capteur+'"></td>'+
								              '<td><a class="btn btn-sm btn-info edit-product" style="color:#fff;"><span style="display:none;">'+JSON.stringify(value)+'</span><i class="fas fa-pencil-alt"></i></a>&nbsp;<a pid="'+value.id+'" class="btn btn-sm btn-danger delete-product" style="color:#fff;"><i class="fas fa-trash-alt"></i></a></td>'+
								              '<td>'+ value.valeur +'</td>'+'</tr>';

						});

						$("#product_list").html(productHTML);
					}

				}
			}

		});
	}

	getProducts();

	$(".add-product").on("click", function(){

		$.ajax({

			url : '../admin/classes/Temperature.php',
			method : 'POST',
			data : new FormData($("#add-product-form")[0]),
			contentType : false,
			cache : false,
			processData : false,
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					$("#add-product-form").trigger("reset");
					$("#add_product_modal").modal('hide');
					getProducts();
				}else if(resp.status == 303){
					alert(resp.message);
				}
			}

		});

	}); 

	$(document.body).on('click', '.edit-product', function(){

		console.log($(this).find('span').text());

		var product = $.parseJSON($.trim($(this).find('span').text()));

		console.log(product);

		$("input[name='e_product_name']").val(capteurs.nom_capteur);
		$("input[name='e_product_image']").siblings("img").attr("src", "../product_images/"+capteurs.image_capteur);
		$("input[name='pid']").val(capteurs.id);
		$("#edit_product_modal").modal('show');

	});

	$(".submit-edit-product").on('click', function(){

		$.ajax({

			url : '../admin/classes/Temperature.php',
			method : 'POST',
			data : new FormData($("#edit-product-form")[0]),
			contentType : false,
			cache : false,
			processData : false,
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					$("#edit-product-form").trigger("reset");
					$("#edit_product_modal").modal('hide');
					getProducts();
					alert(resp.message);
				}else if(resp.status == 303){
					alert(resp.message);
				}
			}

		});


	});

	$(document.body).on('click', '.delete-product', function(){

		var pid = $(this).attr('pid');
		if (confirm("Voulez vous vraiment supprimer ?")) {
			$.ajax({

				url : '../admin/classes/Temperature.php',
				method : 'POST',
				data : {DELETE_PRODUCT: 1, pid:pid},
				success : function(response){
					console.log(response);
					var resp = $.parseJSON(response);
					if (resp.status == 202) {
						getProducts();
					}else if (resp.status == 303) {
						alert(resp.message);
					}
				}

			});
		}else{
			alert('Annulé');
		}
		

	});


	

});