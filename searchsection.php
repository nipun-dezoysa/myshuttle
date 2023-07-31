<?php 
$resultss=mysqli_query($connection,"SELECT * FROM city ORDER BY name ASC");
$data = array();
foreach($resultss as $row)
{
    $data[] = $row['name'];
}
 ?>
<div class="searchs bg-primary">
      <div class="container box">
         <center><h1 class="display-4">Find Your Destination</h1></center>
         <form action="results.php">
          <div class="search-box">
            <div class="autocomplete"><input type="text" id="ori" name="start" autocomplete="off" placeholder="Enter Origin" <?php if(isset($_GET['start']))echo "value='".$_GET['start']."'" ?>></div>
            <i onclick="changedes()" class="fa-solid fa-right-left chnge-pic"></i>
            <div class="autocomplete"><input type="text" id="des" name="end" autocomplete="off" placeholder="Enter Destination"<?php if(isset($_GET['end']))echo "value='".$_GET['end']."'" ?>></div>
            <select name="type">
              <option value="0" <?php if(isset($_GET['type'])){if($_GET['type']==0)echo 'selected';} ?>>All</option>
              <option value="1" <?php if(isset($_GET['type'])){if($_GET['type']==1)echo 'selected';} ?>>Shuttle</option>
              <option value="2" <?php if(isset($_GET['type'])){if($_GET['type']==2)echo 'selected';} ?>>Services</option>
            </select>
            <input type="submit" class="search-btn" value="Search">
         </div>
         </form>
      </div>
    </div>
    <script src="js/autocomplete.js"></script>
    <script>
      var countries = <?php echo json_encode($data); ?>;
      autocomplete(document.getElementById("ori"), countries);
      autocomplete(document.getElementById("des"), countries);
      function changedes(){
          var start = $("#ori").val();
          var end = $("#des").val();
          document.getElementById("ori").value = end;
          document.getElementById("des").value = start;
      }
    </script>
    