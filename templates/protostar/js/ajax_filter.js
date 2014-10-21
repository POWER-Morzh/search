function searchSuggest() {
  var str = escape(document.getElementById('filter_keywords').value);
  var xmlhttp;
  
  // If nothing in city field
  if (str.length==0) { 
    document.getElementById("city_suggest").innerHTML="";
    return;
  }
  
  // Initialize XMLHttpRequest object
  if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

  // Do action  
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("city_suggest").innerHTML = xmlhttp.responseText;
    }
  }
  
  
  // Request
  xmlhttp.open("GET",'filter_result.php?search=' + str,true);
  xmlhttp.send();
}


function PutInCity(value, str) {
  document.getElementById("city_hidden").value = value;
  document.getElementById("city_suggest").style.display = "none";
  document.getElementById("filter_keywords").value = '';
  document.getElementById("filter_keywords").style.display = "none";
  document.getElementById("city_chosen").innerHTML = '<a onclick="ResetCityFilter()">' + str + "</a>";
}

function ResetCityFilter() {
  document.getElementById("filter_keywords").value = '';
  document.getElementById("city_hidden").value = '';
  document.getElementById("city_suggest").innerHTML = '';
  document.getElementById("city_suggest").removeAttribute("style");;
  document.getElementById("filter_keywords").removeAttribute("style");
  document.getElementById("city_chosen").innerHTML = '';
}