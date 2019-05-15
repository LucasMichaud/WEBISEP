<?php 
include("General.php");
$bdd = new PDO("mysql:host=localhost;dbname=espace_membre",'root','');
if(isset($_SESSION['id']) AND $_SESSION['id']>0)
{
  $getid = intval($_SESSION['id']);
   ?>
<html>
<head>
	<title>Catalogue</title>
	<link rel="stylesheet" href="design/Expertise.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
  <meta charset="utf-8">
</head>
<body>

	<h2>Catalogue</h2>
	

<div id="live_cat"></div>
<script>

$(document).ready(function(){  
    function fetch_cat() {  
      $.ajax({  
        url:"index.php?action=cat_fetch",  
        method:"POST", 
        success:function(data){  
          $('#live_cat').html(data);  
        }  
      });  
    }  
    fetch_cat();  
    $(document).on('click', '#btn_add_cat', function(){  
      var cat_name = $('#cat_name').text();
      var cat_desc = $('#cat_desc').text(); 
      var cat_price = $('#cat_price').text();   
      var cat_weight = $('#cat_weight').text(); 
      var cat_type = $('#cat_type').text(); 
        if(cat_name == '' || cat_desc == '' || cat_price == '' || cat_weight == '' || cat_type == '') {    
          return false;  
        }
      $.ajax({  
        url:"index.php?action=cat_add",  
        method:"POST",  
        data:{cat_name:cat_name,cat_desc:cat_desc,cat_price:cat_price,cat_weight:cat_weight,cat_type:cat_type},  
        dataType:"text",  
        success:function(data) {   
          fetch_cat();  
        }  
      })  
    });  
    function edit_cat(id, text, column_name) {  
      $.ajax({  
        url:"index.php?action=cat_edit",  
        method:"POST",  
        data:{id:id, text:text, column_name:column_name},  
        dataType:"text",  
        success:function(data){
        }  
      });  
      }  
    $(document).on('blur', '.cat_name', function(){  
      var id = $(this).data("id1");  
      var cat_name = $(this).text();  
      edit_cat(id, cat_name, "CatName");  
    }); 
    $(document).on('blur', '.cat_desc', function(){  
      var id = $(this).data("id2");  
      var cat_desc = $(this).text();  
      edit_cat(id, cat_desc, "CatDesc");  
    }); 
    $(document).on('blur', '.cat_price', function(){  
      var id = $(this).data("id3");  
      var cat_price = $(this).text();  
      edit_cat(id, cat_price, "CatPrice");  
    }); 
    $(document).on('blur', '.cat_weight', function(){  
      var id = $(this).data("id4");  
      var cat_weight = $(this).text();  
      edit_cat(id, cat_weight, "CatWeight");  
    });
    $(document).on('blur', '.cat_type', function(){  
      var id = $(this).data("id5");  
      var cat_type = $(this).text();  
      edit_cat(id, cat_type, "CatType");  
    });    
    $(document).on('click', '.btn_delete_cat', function(){  
      var id=$(this).data("id6");  
      $.ajax({  
        url:"index.php?action=cat_remove",  
        method:"POST",  
        data:{id:id},  
        dataType:"text",  
        success:function(data){ 
          fetch_cat();  
        }  
      });  
    });  
});

</script>
</body>
</html>
<?php } ?>