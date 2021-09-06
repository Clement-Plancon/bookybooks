<link rel="stylesheet" href="toastB.css">


<button onclick="showToast('Toast text')">Show Toast</button>
<div id="toast"></div>



<script>


function showToast(text){
  var x=document.getElementById("toast");
  x.classList.add("show");
  x.innerHTML=text;
  setTimeout(function(){
    x.classList.remove("show");
  },3000);
}

</script>