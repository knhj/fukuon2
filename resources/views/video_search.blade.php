@extends('layouts.master')

@section('title', 'Fukuon 検索ページ- 副音声共有サービス')

@section('content')

<div  class="jumbotron container py-3">
  <div class="search">
      <div class="d-flex mb-2">
   <image style="width:40px;height:40px;" src="/image/search.png"><h2 class="mb-0 ml-3" style="line-height:40px;">動画キーワード検索</h2>
   </div>
    <div style="width:80%;" class="input-group mb-3" id="search_form">
       <input id="input" type="text" class="form-control"  placeholder="動画検索キーワード" aria-label="検索キーワード" aria-describedby="basic-addon1" >
       <div class="input-group-append">
       <button id="search_btn" class="btn btn-secondary" type="button">検索</button>
       </div>
    </div>
  </div>
  <div id="result"></div>
  <div id="setbtn" class=""></div>
</div>

<script>
const search_btn = document.getElementById("search_btn");
const result = document.getElementById("result");
const input= document.getElementById("input");
const setbtn = document.getElementById("setbtn");
var pageToken = "";

search_btn.addEventListener('click', function(e) {
   
// console.log(input.value);
var ajax = new XMLHttpRequest();
    ajax.open("get", 'https://www.googleapis.com/youtube/v3/search?part=snippet&videoDuration=short&type=video&maxResults=20&q=' + input.value + '&order=viewCount&key=AIzaSyDujH8RbX5ji2m4lrCeZO9PziawwLxQCfk');
    ajax.responseType = 'json';
    ajax.send();
    ajax.onload = function (e) {
    //   console.log(this.response.items[0].id.videoId);
    //  console.log(this.response.nextPageToken);
      delete_search_form();
      pageToken = this.response.nextPageToken;
     
     var tmp = '<div class="row my-5 border-bottom border-dark"><div class="col-10 pl-5" style="font-size:1.2em;" id="result_title">検索結果</div><div class="col-2 text-center" style="font-size:1.2em;" id="result_on">副音声投稿数</div></div>';
    
    
    
     var array = [];
      for (var i = 0; i < this.response.items.length; i++) {
        
        var videoid = this.response.items[i].id.videoId;
        var thmbnailurl = this.response.items[i].snippet.thumbnails.medium.url;
        var vtitle = this.response.items[i].snippet.title;
        array.push(videoid);
        
      tmp += '<div class="row mb-2 ">';
      tmp +=   '<a class="col-10" href="/part/'+ videoid +'">';
      tmp +=     '<div class="col-10 d-inline-flex flex-row" id="result_title">';
      tmp +=       '<img class="img-thumbnail" style="width:128px;height:72px" src="' + thmbnailurl + '">';
      tmp +=       '<div >'+vtitle+'</div>';
      tmp +=     '</div>';
      tmp +=   '</a>';
      tmp +=  '<div class="col-2 text-center" id="'+ videoid+'">';
      tmp +=  '</div>';
      tmp += '</div>';
    }
        
       setbtn.classList.add("btn");
       setbtn.classList.add("btn-outline-dark");
       setbtn.classList.add("btn-block");
       setbtn.innerHTML = "さらに読み込む...";
       result.innerHTML = tmp;
       
       for(let i = 0; i < array.length; i++) {
    //   console.log(array[i]);
       number_count(array[i]);
       }
       
       
       
    };

// console.log("test");

});

setbtn.addEventListener('click', function(e) {
    var ajax = new XMLHttpRequest();
    ajax.open("get", 'https://www.googleapis.com/youtube/v3/search?part=snippet&type=video&maxResults=20&q=' + input.value + '&order=viewCount&pageToken='+ pageToken +'&key=AIzaSyDujH8RbX5ji2m4lrCeZO9PziawwLxQCfk');
    ajax.responseType = 'json';
    ajax.send();
    ajax.onload = function (e) {
    // console.log(this);
    var tmp = "";
    pageToken = this.response.nextPageToken;
    
    
    
     var array = [];
      for (var i = 0; i < this.response.items.length; i++) {
     var videoid = this.response.items[i].id.videoId;
     var thmbnailurl = this.response.items[i].snippet.thumbnails.medium.url;
     var vtitle = this.response.items[i].snippet.title;
    array.push(videoid);
     
      tmp += '<div class="row mb-2 ">';
      tmp +=   '<a class="col-10" href="/part/'+ videoid +'">';
      tmp +=     '<div class="col-10 d-inline-flex flex-row" id="result_title">';
      tmp +=　 '<img class="img-thumbnail" style="width:128px;height:72px" src="' + thmbnailurl + '">';
      tmp +=  '<div >'+vtitle+'</div>';
      tmp +=     '</div>';
      tmp +=   '</a>';
      tmp +=  '<div class="col-2 text-center" id="'+ videoid+'">';
      tmp +=  '</div>';
      tmp += '</div>';
     
    }
    
    result.insertAdjacentHTML('beforeend', tmp);
    
     for(let i = 0; i < array.length; i++) {
    //   console.log(array[i]);
       number_count(array[i]);
       
       }
    }
    
});


function number_count(vid){
    const getvid = document.getElementById(vid);
    var a = new XMLHttpRequest();
    a.open("get", "/number/"+vid);
    a.responseType = 'json';
    a.send();
    a.onload = function (e) {
    //  console.log(e.currentTarget.response);
     getvid.innerHTML = e.currentTarget.response;
    }
    
}

function delete_search_form(){
    var search_form = document.getElementById("search_form");
    search_form.style.display = 'none';
}




</script>





@endsection