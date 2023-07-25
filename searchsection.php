<div class="searchs bg-primary">
      <div class="container box">
         <center><h1 class="display-4">Find Your Destination</h1></center>
         <form action="results.php">
          <div class="search-box">
            <input type="text" id="ori" name="start" placeholder="Enter Origin" <?php if(isset($_GET['start']))echo "value='".$_GET['start']."'" ?>>
            <i class="fa-solid fa-right-left"></i>
            <input type="text" id="des" name="end" placeholder="Enter Destination"<?php if(isset($_GET['end']))echo "value='".$_GET['end']."'" ?>>
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
    