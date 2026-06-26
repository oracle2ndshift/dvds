function CatIdToName(v_catid) {
switch(v_catid)
  {
  case 1:
   v_catname = 'Action';
   break;
  case 2:
   v_catname = 'Adventure';
   break;
  case 4:
   v_catname = 'Animation';
   break;
  case 8:
   v_catname = 'Biography';
   break;
  case 16:
   v_catname = 'Black & White';
   break;
  case 32:
   v_catname = 'Comedy';
   break;
  case 64:
   v_catname = 'Concert';
   break;
  case 132:
   v_catname = 'Crime';
   break;
  case 264:
   v_catname = 'Documentary';
   break;
  case 512:
   v_catname = 'Drama';
   break;
  case 1024:
   v_catname = 'Family';
   break;
  case 2048:
   v_catname = 'Fantasy';
   break;
  case 4096:
   v_catname = 'Film-Noir';
   break;
  case 8192:
   v_catname = 'History';
   break;
  case 16384:
   v_catname = 'Horror';
   break;
  case 32768:
   v_catname = 'Music';
   break;
  case 65536:
   v_catname = 'Mystery';
   break;
  case 131072:
   v_catname = 'Romance';
   break;
  case 262144:
   v_catname = 'Sci-Fi';
   break;
  case 524288:
   v_catname = 'Sport';
   break;
  case 1048576:
   v_catname = 'Thriller';
   break;
  case 2097152:
   v_catname = 'War';
   break;
  case 4194304:
   v_catname = 'Western ';
 break;
  default:
   v_catname = '';
  }
  return v_catname;
}

function AddCatname() {
  var v_catid_selected = AddForm.v_catid_selected.value;
  var v_catname        = AddForm.v_catname.value;
  var v_catid          = AddForm.v_catid.value;
   
  v_catid = v_catid * 1;
  v_catid_selected = v_catid_selected * 1;

  if (v_catid_selected == 0) {
    v_catid = 0;
    v_catname = '';
  }
  else {
    v_catid = v_catid + v_catid_selected;
    v_catname = v_catname + CatIdToName(v_catid_selected) + ' | ';
  }

  AddForm.v_catname.value = v_catname;
  AddForm.v_catid.value = v_catid;
}

function UpdCatname() {
  var v_catid_selected = UpdForm.v_catid_selected.value;
  var v_catname        = UpdForm.v_catname.value;
  var v_catid          = UpdForm.v_catid.value;
   
  v_catid = v_catid * 1;
  v_catid_selected = v_catid_selected * 1;

  if (v_catid_selected == 0) {
    v_catid = 0;
    v_catname = '';
  }
  else {
    v_catid = v_catid + v_catid_selected;
    v_catname = v_catname + CatIdToName(v_catid_selected) + ' | ';
  }

  UpdForm.v_catname.value = v_catname;
  UpdForm.v_catid.value = v_catid;
}

function yes_or_no() {
  let text = confirm("Are you sure? ");
  if (confirm(text) == true) {
     let ret = true; 
  } else {
     let ret = false; 
  }
  document.getElementById("yes_or_no").innerHTML = ret;
  return ret;
}
