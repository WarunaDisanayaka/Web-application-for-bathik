const searchBar=document.querySelector(".users .search input");
searchBtn =document.querySelector(".users .search button");
usersList=document.querySelector(".users .users-list");

//Search button function
searchBtn.onclick=()=>{
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active");
    searchBar.value="";
}

//Keyup function
searchBar.onkeyup=()=>{
    let searchTerm=searchBar.value;

    if (searchTerm !="") {
        searchBar.classList.add("active");
    }else{
        searchBar.classList.remove("active");
    }

    let xhr=new XMLHttpRequest();
    xhr.open("POST","search.php",true);
    xhr.onload=()=>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status===200) {
                let data=xhr.response;
                usersList.innerHTML=data;
            }
        }
    }
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.send("searchTerm="+searchTerm);
}

//Interval function
setInterval(()=>{
    let xhr=new XMLHttpRequest();
    xhr.open("GET","getUsers.php",true);
    xhr.onload=()=>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status===200) {
                let data=xhr.response;
                if(!searchBar.classList.contains("active")){
                    usersList.innerHTML=data;
                }
            }
        }
    }
    xhr.send();
},500);