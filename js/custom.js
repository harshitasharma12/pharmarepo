$(".addItemBtn").click(function(){
	//alert("hi");
	//var $form=$(this).closest(".form-submit");
	//var pid=$form.find(".pid").val();
	var pid = $(this).data("id");
	var cid = $(this).data("customer"); 
	var btn = '#btn-'+pid;
	var btn_cart = '#btn-cart-'+pid;
	$.ajax({
		type:'POST',
		url:'ajax.php',
		data : {pid:pid,cid:cid},
		success:function(response){
			$("#message").html(response);
			$(btn).addClass("d-none");
			$(btn_cart).removeClass("d-none");
		}

	})
});

$(".addlabtestBtn").click(function(){
	//alert("hi");
	//var $form=$(this).closest(".form-submit");
	//var pid=$form.find(".pid").val();
	var lid = $(this).data("id");
	var cid = $(this).data("customer"); 
	var btn = '#btn-'+lid;
	var btn_cart = '#btn-cart-'+lid;
	$.ajax({
		type:'POST',
		url:'ajax.php',
		data : {lid:lid,cid:cid},
		success:function(response){
			$("#message").html(response);
			$(btn).addClass("d-none");
			$(btn_cart).removeClass("d-none");
		}

	})
});


$(".deleteBtn").click(function(){
	var cartid=$(this).data("cartid");
	var btn='#btn-'+cartid;
	var card = '#card-'+cartid;
	$.ajax({
		type:'POST',
		url:'ajax.php',
		data : 'cartid='+cartid,
		success:function(response){
		obj= JSON.parse(response);
		$("#message").html(obj.items);
		$("#cart_items").html(obj.items);
		$('#totalprice').html(obj.total);
		$('#discount').html(obj.discount);
		$('#net_amount').html(obj.net_amount);
		
		// $("#cart_items").html(response);
		$(card).fadeOut(300, function() {
            $(card).remove();
        });
		if(obj.items=="0"){
			 
			$("#my_cart").addClass("d-none");
			$("#empty_cart").removeClass("d-none");
			$("#empty_cart").addClass("d-block");
		} 
		}
	});
});



$(".addOne").click(function(){
	//alert("hi");
	var id = $(this).data("add");
	var cart_id =  '#cart-'+ id; //#cart-15
 	var qty = parseInt($(cart_id).val())+1;
	$(cart_id).val(qty);

	let price_id = '#product_'+id;
	let text_id = '#text_'+id;
	let price = (parseFloat($(price_id).val())*qty).toFixed(2);
	//$(price_id).val(price);
	$(text_id).text(price);
	$.ajax({
		type:'POST',
		url:'ajax.php',
		data :{cart_id:id,qty:qty},
		success:function(response){
			obj= JSON.parse(response);
			$('#discount').html(obj.discount);
			$('#totalprice').html(obj.total);
			$('#net_amount').html(obj.net_amount);
		}
	})

});


$(".subOne").click(function(){
	//alert("hi");
	var id = $(this).data("sub");
	var cart_id =  '#cart-'+ id;
	var qty = parseInt($(cart_id).val());
	
	if(qty>1){
		qty = qty-1
	} else {
		qty = 1;
	}
	$(cart_id).val(qty);

	let price_id = '#product_'+id;
	let text_id = '#text_'+id;
	let price = (parseFloat($(price_id).val())*qty).toFixed(2);
	$(text_id).text(price);
	$.ajax({
		type:'POST',
		url:'ajax.php',
		data :{cart_id:id,qty:qty},
		success:function(response){
			obj= JSON.parse(response);
			$('#discount').html(obj.discount);
			$('#totalprice').html(obj.total);
			$('#net_amount').html(obj.net_amount);
		}
	})


});

$('#country_id').on("change",function(){
	var country_id = $(this).val();
	// console.log(country_id);
	$.ajax({
	  type:'POST',
	  url : 'ajax.php',
	  data : 'country_id='+country_id,
	  success:function(html){
	     //console.log(html);
	    $("#state_id").html(html);
	    
	  }
	});
});

$('#state_id').on("change",function(){
	var state_id = $(this).val();
	// console.log(state_id);
	$.ajax({
	  type:'POST',
	  url : 'ajax.php',
	  data : 'state_id='+state_id,
	  success:function(html){
	     //console.log(html);
	    $("#city_id").html(html);
	    
	  }
	});
});

$('.inpaddress').on("click",function(){
	var id = $(this).data("id");
	var btnEdit = '#btn-edit-'+id;
	var btnDelivery = '#btn-delivery-'+id;
	$('.btn-edit').addClass('d-none');
	$('.btn-delivery').addClass('d-none');
	$(btnEdit).removeClass('d-none');
	$(btnDelivery).removeClass('d-none');
	$.ajax({
		type:'POST',
		url : 'ajax.php',
		data : 'address_id='+id,
		success:function(html){
		   //console.log(html);
		  $("#city_id").html(html);
		  
		}
	  });

	
});

$('#cashondelivery').on("click",function(){
	$('#cash').removeClass("d-none");
	$('#onlinepay').addClass("d-none");
});

$('#online').on("click",function(){
	$('#onlinepay').removeClass("d-none");
	$('#cash').addClass("d-none");
});

$("#filter").change(function() {
    var filter = $(this).val();
	var cat_id=$(this).data("cat");
	var sub_id=$(this).data("sub");
	var detail_id=$(this).data("detail");
	var brand_id=$(this).data("brand");
	// alert(detail_id);
	// var show_brand_id=$(this).data("brand_show")
	$.ajax({
	  type:'POST',
	  url : 'ajax.php',
	  data : {filter:filter,cat_id:cat_id,sub_id:sub_id,detail_id:detail_id,brand_id:brand_id},
	  success:function(html){
	    $("#price_sorted").html(html);
	    
	  }
	});
});

$("#filterbrand").change(function() {
	var filterbrand = $(this).val();
	var show_brand_id=$(this).data("brand_show")
	// alert(show_brand_id);
	$.ajax({
	  type:'POST',
	  url : 'ajax.php',
	  data : {filterbrand:filterbrand,show_brand_id:show_brand_id},
	  success:function(html){
	    $("#price_sorted").html(html);
	    
	  }
	});
});

$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
	autoplay:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})



