var search = document.getElementById("search");

search.onkeydown = search.onkeyup = search.onkeypress = function (event){
    var searchText = search.value.toLowerCase().split(" ");
    var tableRows = document.getElementsByName("data-row");
    for(i = 0;i < tableRows.length;i++){
      var findAny = false;
      for(j = 0; j < searchText.length;j++){
        if(tableRows[i].innerHTML.toLowerCase().includes(searchText[j])) findAny = true;
        else {
          findAny = false;
          break;
        }
      }
      if(findAny) {
        if(tableRows[i].hasAttribute("style")) tableRows[i].removeAttribute("style"); 
      } else tableRows[i].setAttribute("style", "display: none;");
    }
  }
  