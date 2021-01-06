function displaycust()
{
  document.getElementById('transferForm').style.display="block";
  $(".alert").alert('close')
}

$(document).ready(function(){
$("#alert").on('close.bs.alert', function(){
    window.history.replaceState( null, null, window.location.href );
});
});