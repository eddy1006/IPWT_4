// document.addEventListener("readystatechange",fetchDetails);
// function fetchDetails(){
//     console.log("I am clicked");
//     const xhr = new XMLHttpRequest();
//     xhr.open('GET','fetch.php',true);
//     xhr.onload = function(){
//         if(this.status === 200){
//             document.getElementById("table").innerHTML = this.responseText;
//         }
//         else{
//             console.log('something went wrong');
//         }
//     }
//     xhr.send();
// }

$(document).ready(function(){
    $.ajax({url: "fetch.php",async : true,success:function(result){
        $("#table").html(result);
    }})
})
