function ajaxQuery($script,$id,$data) {
var xhr;
var script;
var id;
var data = null;
alert("Query: "+$data+"\nScript: "+$script+"\nid: "+$id);
xhr = new XMLHttpRequest();
xhr.onreadystatechange = function()
    {
         if(xhr.readyState  == 4)
         {
              if(xhr.status  == 200)
				if($id) document.getElementById($id).innerHTML = xhr.responseText;
				else alert(xhr.responseText);
              else
                alert("AJAX. Could not get data. Error code " + xhr.status + " " + xhr.statusText);
         }
    };
		if($data) $method = 'post';
		else $method = 'get';
		alert($method);
   xhr.open($method, $script,  true);
   xhr.send($data);
}

/**
 *
 * @access public
 * @return void
 **/
function getidppp($id){
	document.getElementById($id).innerHTML = $id;
}