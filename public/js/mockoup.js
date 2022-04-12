

var logout = document.querySelector('[ng-click="pHeader.logOut()"]');
var back = document.querySelector('[src="./img/arrow_left.svg"]');

logout.addEventListener('click', function(){
  location.href ='./Login.html';
});
if(back){
  back.parentNode.addEventListener('click', function(){
    history.back();
  
  });
  
}


window.onload = function() {
  var title = document.querySelector("title");
  title.innerHTML = "BCP通知";
};

var getButton = function(searchButtonText){
  var buttons = document.querySelectorAll('button');
  for (i =0;i<buttons.length;i++){
    var buttonText =  buttons[i].innerHTML.replace( /<("[^"]*"|'[^']*'|[^'">])*>/g , '' );
    searchButtonText = searchButtonText.replace( /\n/g , '' ).replace(/\s+/g, "");;
    buttonText =  buttonText.replace( /\n/g , '' ).replace(/\s+/g, "");;
    
    if(buttonText == searchButtonText){
      return buttons[i];
    }
  }
}
var buttonActive  = function(buttonText){
  var button = getButton(buttonText);
  if(button === undefined) return;
  button.classList.remove('disabled');
  button.disabled = '';

}
var listData = document.querySelector("#listData");
if(listData != undefined){
  newHeight = document.querySelector(".app").clientHeight - listData.offsetHeight - 100;
 // listData.style.height = "calc(100vh - " + newHeight + "px)";
}

var addButtonClickEvent = function(buttonText,url){
  
  var button = getButton(buttonText);
  if(button === undefined) return;
  button.addEventListener('click', function(){
    location.href = url;
  
  });
}

  var table = document.querySelectorAll('#listData tbody tr');
  console.log("xx");
  if(table){
    table.forEach(function (tr){
   
      tr.addEventListener('click', function(){
        table.forEach(function (tr){
          tr.classList.remove("row-selected");
        });
 
        tr.classList.add("row-selected");
       
      });
    });
  }

    
  
