<?php
//
$php_self = $_SERVER['PHP_SELF'];

//
// form hints
//
$form_q_title = 'Enter zero or more letters for the beginning of the title.';
$form_title = 'Enter title of DVD.';
$form_category = 'Select category to add to the list.  Select NONE to zero the list and create a new category list.';
$form_q_category = 'Select query category.';
$form_q_upddate = 'Enter date (yyyy-mm-dd) to query for all dvds shelved on or after this date.';
$form_submitupd = 'Click to update this DVD record.';
$form_submitdel = 'Click to delete this DVD record.';
$form_submitadd = 'Click to add a DVD record.';
$form_submitque = 'Click to query the DVD library.';
$form_uploadfile = 'Enter or browse for gif file upload.';

//
// local variables
//
$cat_opt = "<option value='1'>Action</option><br>\n" .
           "<option value='2'>Adventure</option><br>\n" .
           "<option value='4'>Animation</option><br>\n" .
           "<option value='8'>Biography</option><br>\n" .
           "<option value='16'>Black & White</option><br>\n" .
           "<option value='32'>Comedy</option><br>\n" .
           "<option value='64'>Concert</option><br>\n" .
           "<option value='132'>Crime</option><br>\n" .
           "<option value='264'>Documentary</option><br>\n" .
           "<option value='512'>Drama</option><br>\n" .
           "<option value='1024'>Family</option><br>\n" .
           "<option value='2048'>Fantasy</option><br>\n" .
           "<option value='4096'>Film-Noir</option><br>\n" .
           "<option value='8192'>History</option><br>\n" .
           "<option value='16384'>Horror</option><br>\n" .
           "<option value='32768'>Music</option><br>\n" .
           "<option value='65536'>Mystery</option><br>\n" .
           "<option value='131072'>Romance</option><br>\n" .
           "<option value='262144'>Sci-Fi</option><br>\n" .
           "<option value='524288'>Sport</option><br>\n" .
           "<option value='1048576'>Thriller</option><br>\n" .
           "<option value='2097152'>War</option><br>\n" .
           "<option value='4194304'>Western</option><br>\n";
?>
