
<html>
<head>
  <link rel="stylesheet" href="design/parametre.css" />
    <meta charset="utf-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
<title>paramètres</title> 
</head>
<body>
   
<?php if (isset($_SESSION['id'])) {
  $getid = intval($_SESSION['id']); ?>
  <div id="content">
    <div id="family">
      <div id="live_status"></div>
      <!-- <table>
        <tr>    
              <td><button type="button" name="btn_delete_family" data-id1="'.$row[""].'" class="btn_delete_family"><i class="material-icons">delete</i></button></td> 
              <td class="family_name" data-id2="'.$row["LampID"].'" contenteditable></td> 
              <td> 
                <select name="room" id="langue">
                  foreach() {
                    <option value="$row['RoomID']">$row['RoomName']</option>
                  }
                </select>  
              </td>
              <td><button type="button" name="btn_add_room" id="btn_add_room"><i class="material-icons">add</i></button></td> 
        </tr>
        <tr>      
            <td><button type="button" name="btn_add_lamp" id="btn_add_lamp"><i class="material-icons">add</i></button></td> 
            <td id="lamp_name" contenteditable>Nouvelle Lampe</td> 
       </tr> 
      </table> -->
    </div>
 
   <fieldset>
       <legend>Notifications</legend>
 
       <p>
           Vous voulez recevoir vos notifications par :

           <input type="radio" name="notifications" value="sms" id="sms" /> <label for="sms">sms</label>
           <input type="radio" name="notifications" value="email" id="email" /> <label for="email">e-mail</label>
           <input type="radio" name="notifications" value="les deux" id="les deux" /> <label for="les deux">sms et e-mail</label>
           <input type="radio" name="notifications" value="aucune" id="aucune" /> <label for="aucune">Ne recevoir <strong> aucunes </strong>   notifications</label>
       </p>
   </fieldset>

<fieldset>
  <legend>Langues</legend>
     <p>
       <label for="langue">Choix de la <strong>langue</strong></label><br />
       <select name="langue" id="langue">
           <option value="français">français</option>
           <option value="espagnol">español</option>
           <option value="italien">italiano</option>
           <option value="anglais">english</option>
           <option value="chinois">中国</option>
       </select>
   </p>
</fieldset>
</form>
</div>
<?php } 
else{
    header('Location:index.php?action=connexion');
}
  ?>
</body>
</html>
<script>
  $(document).ready(function(){  
    function fetch_status() { 
    var idm = "<?= $getid ?>"; 
      $.ajax({  
        url:"index.php?action=status_fetch",  
        method:"POST", 
        data:{idm:idm},  
        dataType:"text", 
        success:function(data){  
          $('#live_status').html(data);  
        }  
      });  
    }  
    fetch_status();  
    $(document).on('click', '#btn_add_status', function(){  
      var status_name = $('#status_name').text();
        if(status_name == '') {    
          return false;  
        }
      $.ajax({  
        url:"index.php?action=status_add",  
        method:"POST",  
        data:{status_name:status_name},  
        dataType:"text",  
        success:function(data) {   
          fetch_status();  
        }  
      })  
    });  
    function edit_status(id, text) {  
      $.ajax({  
        url:"index.php?action=status_edit",  
        method:"POST",  
        data:{id:id, text:text},  
        dataType:"text",  
        success:function(data){
        }  
      });  
      }  
    $(document).on('blur', '.status_name', function(){  
      var id = $(this).data("id1");  
      var status_name = $(this).text();  
      edit_status(id, status_name);  
    }); 
    $(document).on('click', '.btn_delete_status', function(){  
      var id=$(this).data("id2");  
      $.ajax({  
        url:"index.php?action=status_remove",  
        method:"POST",  
        data:{id:id},  
        dataType:"text",  
        success:function(data){ 
          fetch_status();  
        }  
      });  
    });  
});
</script>
