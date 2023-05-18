$('#category_id').on("change",function(){
	var category_id = $(this).val();
	$.ajax({
	  type:'POST',
	  url : 'ajax.php',
	  data : 'category_id='+category_id,
	  success:function(html){
	     //console.log(html);
	    $("#sub_category_id").html(html);
	    
	  }
	});
});

$('#sub_category_id').on("change",function(){
	var sub_category_id = $(this).val();
	$.ajax({
	  type:'POST',
	  url : 'ajax.php',
	  data : 'sub_category_id='+sub_category_id,
	  success:function(html){
	     //console.log(html);
	    $("#sub_sub_category_id").html(html);
	    
	  }
	});
});

$('#country_id').on("change",function(){
	var country_id = $(this).val();
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


tinymce.init({
	selector:'textarea#product_directions',
	plugins:'lists advlist link image',
	toolbar:'undo redo | styles | bold italic |link image | numlist bullist'
});

tinymce.init({
	selector:'textarea#product_key_benefits',
	plugins:'lists advlist link image',
	toolbar:'undo redo | styles | bold italic |link image | numlist bullist'
});

tinymce.init({
	selector:'textarea#product_safety_information',
	plugins:'lists advlist link image',
	toolbar:'undo redo | styles | bold italic |link image | numlist bullist'
});

tinymce.init({
	selector:'textarea#labtest_test_name',
	plugins:'lists advlist link image',
	toolbar:'undo redo | styles | bold italic |link image | numlist bullist'
});

tinymce.init({
	selector:'textarea#doctor_education',
	plugins:'lists advlist link image',
	toolbar:'undo redo | styles | bold italic |link image | numlist bullist'
});

tinymce.init({
	selector:'textarea#doctor_experience',
	plugins:'lists advlist link image',
	toolbar:'undo redo | styles | bold italic |link image | numlist bullist'
});

tinymce.init({
	selector:'textarea#doctor_awards',
	plugins:'lists advlist link image',
	toolbar:'undo redo | styles | bold italic |link image | numlist bullist'
});

tinymce.init({
	selector:'textarea#field_of_expertise',
	plugins:'lists advlist link image',
	toolbar:'undo redo | styles | bold italic |link image | numlist bullist'
});