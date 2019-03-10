@extends('layouts.master')

@section('title', 'Fukuon - 副音声共有サービス')

@section('content')

<!--リスト用DOM-->
 <div id="list" class="jumbotron py-3">
     <div class="d-flex mb-2">
        <image style="width:40px;height:40px;" src="/image/head.png">
        <h2 class="mb-0 ml-3" style="line-height:40px;">新着副音声</h2>
     </div>
   
    <table class="table table-borderless table-hover">
        <thead class="bg-gray border-bottom border-dark">
            <tr>
                <th scope="col" class="w-50">副音声タイトル</th>
         <th scope="col">投稿者名</th>
          <th scope="col">投稿日時</th>
          <th scope="col">再生回数</th>
          </tr>
          </thead>
        <tbody id="echo">      
    

        </tbody>
    </table>
</div>
   
   <!--検索用DOM-->
<div id="search" class="jumbotron container py-3">
  <div class="search">
      <div class="d-flex mb-2">
   <image style="width:40px;height:40px;" src="/image/search.png"><h2 class="mb-0 ml-3" style="line-height:40px;">動画キーワード検索</h2>
   </div>
    <div id="search_form" style="width:80%;" class="input-group mb-3">
       <input id="input" type="text" class="form-control"  placeholder="動画検索キーワード" aria-label="検索キーワード" aria-describedby="basic-addon1" >
       <div class="input-group-append">
       <button id="search_btn" class="btn btn-secondary" type="button">検索</button>
       </div>
    </div>
  </div>
  <div id="result"></div>
  <div id="setbtn" class=""></div>
</div>

<!--再生用DOM-->
<!--<div id="playing"></div>-->
 <div id="playing" class="jumbotron pt-3">
    <a id="video_title" class="lead d-block" href="" ></a>
      <div class="d-sm-flex d-flex-column">
        <div>
           <div class="mt-2 mr-5" id="player"></div>
           <div class="form-group d-flex rounded bg-dark text-white w-50 px-3 pt-2 mt-1">
             <label for="soundvalue" class="mr-3" >副音声音量</label>
             <input type="range" class="custom-range" style="width:200px;" id="soundvalue" min="0" max="1" step="0.001" value="1">
           </div>
      </div>
      <div class="w-100">
          <div>
           <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
         </div>
          <div class="rounded bg-secondary w-100 h-100">
          <div class=" bg-dark py-2 mt-1 text-center text-white" >副音声タイトル</div>
          
        <div id="fukuon_title" class="text-white text-justify"></div>
         <div class="bg-dark py-2 mt-1 text-center text-white" >投稿者名</div>
         <div id="user_name" class="text-white text-justify"></div>
         <div class="bg-dark py-2 mt-1 text-center text-white" >コメント</div>
           <div id="user_comment" class="text-white text-justify"></div>
       </div>
      </div>
     </div>
     <!--オーディオ関係。完成形は非表示にする-->
 <audio id="audio" src=""  style="display:none;" controls></audio>
</div> 


<script>
$('#search').hide();
$('#playing').hide();
newlist();


$('#newlist').on('click',function(){
    $('#playing').hide();
    $('#search').hide();
    $('#list').show();
    newlist();
});

$('#ranking').on('click',function(){
     $('#playing').hide();
     $('#search').hide();
    $('#list').show();
    ranking();
});

$('#search_bar').on('click',function(){
     $('#playing').hide();
     $('#list').hide();
    $('#search_form').show();
    // $('#result').children().remove();
    $('#result').empty();
    $('#setbtn').empty();
    $('#setbtn').removeClass();
    $('#search').show();
   
    $('#search_btn').on('click',function(){
        const input= document.getElementById("input");
        // console.log(input.value);
        search(input.value);
        $('#search_form').hide();
        input.value = "";
    });
    //  search();
     
});



</script>
@endsection
