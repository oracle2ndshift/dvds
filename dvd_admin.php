<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<!--- ---------------------------------------------------------------------
* Copyright \302\251 2010-2011 Susie White
*
* Author       - Susie White
*
* Filename     - dvd_admin.php
* 
* Purpose      - dvd library display page
*
* Flow         - Top level script 
*
--------------------------------------------------------------------   --->

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="cache-control" content="no-cache">
  <meta content="text/html;charset=ISO-8859-1" http-equiv="Content-Type">
  <link rel="SHORTCUT ICON" href="gif/favicon.ico" type=text/css>
  <link rel="stylesheet" href="tcs_style_red_3.css" type="text/css" />
  <title>DVD Library</title>
  <script type="text/javascript" src="dvds.js"></script>
</head>
<body>

<?php 
  include '../show_errors.php';
  include 'env.php';
  $config  = include "dbconnect.php";
  $version = $config['version'];
  $dp      = $config['dp'];
  include "dvds.php";
?>

<!-- header -->
<div id="wrapper">
  <div id="header">
    <table width="100%">
      <tr>
        <td align=center width="30%"><font family=Arial size=+2>
              DVD Library<br>Administration Page</font></td>
        <td align=center width="70%"><font family=Arial size=+2>
          <div id="nav_inline">
          <form name="HeaderForm" method="post" 
                action="<?php echo($php_self); ?>">
            <ul id="nav_inline">
              <li title="<?php echo ($form_q_title); ?>"><br><font size=+2>DVD Title<br>
                  <input name="v_title" id="v_title" type="text" size=20 style="font-size:20px;">
              <li><br><br><input type="submit" name="GetQueDiv" style="font-size:20px;"
                           value="Query" title="<?php echo ($form_submitque);?>" >
              <li><br><br><input type="submit" name="GetAddDiv" style="font-size:20px;"
                           value="Add DVD" title="<? echo ($form_submitadd);?>" >
            </ul>
          </form>
          </div></font>
        </td></tr>
    </table>
  </div>
  <div style="clear: both;"></div>
</div>

<!---  main div --->
<div id="nav_main_wrap" >

<?php
  if(!empty($_REQUEST['GetAddDiv'])) :
?>

<!---  add --->
  <p><h2><font style="color:#FFF">Add DVD</font></h2></p>
  <div id="main_dyn" name="main_dyn_add">
    <form enctype="multipart/form-data" name="AddForm" id="AddForm"
          action="<?php echo($php_self); ?>" method=post>
      <table>
      <tr><td>Title<input name="v_title" type=text size=100 value="" 
                     title="<?php echo ($form_title); ?>"><br>
      </td></tr>
      <tr><td align=center>Upload gif file:
            <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
            <input type="file" size=80 name="uploadedfile" 
                        title="<?php echo ($form_uploadfile);?>" />
            &nbsp;&nbsp;&nbsp;
            <input type=submit name="SubmitAdd" VALUE="Submit"></td></tr>
      </table>
    </form>
  </div>

<?php 
  elseif(!empty($_REQUEST['GetUpdDiv'])):
?>

<!---  update --->
  <p><h2><font style="color:#FFF">Update DVD</font></h2></p>
  <div id="main_dyn">
    <form enctype="multipart/form-data" name="UpdForm" 
          action="<?php echo($php_self); ?>" method=post>
      <table>
      <?php
        $v_id         = $_POST['v_id'];
        $v_title      = $_POST['v_title'];
        $v_title      = str_replace("^","'",$v_title);

        echo '<tr><td> '.
             '<input name="v_title" type=text size=110a'.
             ' value="'.$v_title.'" title="'.$form_title.'"><br><br></td></tr>';
        echo "<input type='hidden' name='v_id' value=$v_id />\n";
      ?>
      <tr><td align=center>Optional new gif file:
        <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
        <input type="file" size=80 name="uploadedfile" 
                 title="<?php echo ($form_uploadfile);?>"  />
        &nbsp;&nbsp;&nbsp;
        <input type=submit name="SubmitUpd" VALUE="Submit"></td></tr>
      </table>
    </form>
  </div>

<?php 
  else:

    if(!empty($_REQUEST['GetQueDiv'])) {
      $v_title    = $_POST['v_title'];

      $sql = "select * from dvds where 1=1 ";

      if ($v_title != "") {
        $sql .= " and title like '".$v_title."%'";
      }
    
      $sql .= " order by title";
    
      $result = run_query($version,$db,$sql);
      if (!$result) {
          die("Failed query:  sql=$sql");
      }
      
      echo ("<p><h2><font style='color:#FFF'>DVD Library</font></h2></p>\n");
      echo ("<div id='main_dyn'>\n");
      echo ("<table><tr>\n");
  
      echo ("<tr><td width='110px'></td>".
                "<td width='300px'><font family=Arial size=+2>Title</td>".
                "</tr>\n");

      while($row = run_fetch($version,$result))
      {
          $v_id         = $row["id"];
          $v_title_disp = $row["title"];
      
          $v_title      = str_replace("'",'^',$v_title_disp);

          echo ("<tr>\n");
          echo ("<form name='QueForm_".$v_id."' method='post' action='".$php_self."'>");
            
          echo ("<td><img src='dvds_gif/t".$v_id.".gif' width='80px' height='115px'></td>\n");
          echo ("<td><div style='word-wrap: break-word;'><h3><font size=+2>".$v_title_disp."</font></h3></td>\n");
            
          echo ( "<td>" .
                 "<input type=hidden name='v_id'         value='".$v_id."'>" .
                 "<input type=hidden name='v_title'      value='".$v_title."'>" .
                 "<input type=submit name='GetUpdDiv'    value='Update' ".
                 " title='".$form_submitupd."'>&nbsp;&nbsp;\n".
                 "<input type=submit name='SubmitDel' value='Delete' ".
                 " title='".$form_submitdel."'></td>\n");

          echo ( "</form></tr>\n");
      }
      echo ("</table></div>\n");
      run_free($version,$result);
    }
    if(!empty($_REQUEST['SubmitUpd'])) {
      $v_id         = $_POST['v_id'];
      $v_title      = $_POST['v_title'];
      $uploadedfile = $_POST['uploadedfile'];
      $sql = "update dvds set ".
             " title='".$v_title."' ".
             " where id=".$v_id;

      echo ("<div id='main_dyn'>\n");
      echo "Debug running: ".$sql;

      if (mysql_query($sql)) {
        echo("<P><h3>The dvd has been updated.</h3></P>\n");
      } else {
        echo("<P><h3>Error updating dvd: ".mysql_error()."</h3></P>\n");
      }

      $fp_name  = 'dvds_gif/'.'t'.$v_id.'.gif';
      if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $fp_name)) {
          echo "<h3>The file ".  basename( $_FILES['uploadedfile']['name']).
          " has been uploaded.</h3>";
      } else {
          echo "Error: Upload failed";
      }
      echo ("</div>\n");
    }

    if(!empty($_REQUEST['SubmitDel'])) {
      echo ("<div id='main_dyn'>\n");
      $v_id = $_POST['v_id'];
      $sql = "delete from dvds where id=$v_id";

      if (1 == 1) {
          if(mysql_query($sql)) {
             echo("<P>The dvd has been deleted.</P>\n");
          } else {
            echo("<P>Error running sql: ".$sql."</P>\n");
            echo("<P>Error deleting dvd: ".mysql_error()."</P>\n");
          }
      } 
      echo ("</form></div>\n");
    }

    if(!empty($_REQUEST['SubmitAdd'])) {
      echo ("<div id='main_dyn'>\n");
      $v_title    = $_POST['v_title'];
      $sql = "insert into dvds (title)".
             " values ('".$v_title."');";
      if (mysql_query($sql)) {
        $result = mysql_query('select last_insert_id() t1');
         
        $row = mysql_fetch_array($result);
        $v_id = $row['t1'];

        $fp_name  = 'dvds_gif/'.'t'.$v_id.'.gif';
        if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $fp_name)) {
            echo "<h3>The file ".  basename( $_FILES['uploadedfile']['name']).
            " has been uploaded.</h3>";
        } else{
            echo "<h3>There was an error uploading the file, please try again!</h3>";
        }
        echo("<P><h3>The dvd has been added to your library.</h3></P>\n");
      } else {
        echo("<P><h3>Error running sql: ".$sql."</h3></P>\n");
        echo("<P><h3>Error adding dvd record: ".mysql_error()."</h3></P>\n");
      }
      echo ("</div>\n");
    }
  endif;
?>

</div>
</body>
</html>
