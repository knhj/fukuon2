@extends('layouts.master')

@section('title', 'Fukuon - 副音声共有サービス')

@section('content')


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
   
<div id="search" class="jumbotron container py-3">
  <div class="search">
      <div class="d-flex mb-2">
   <image style="width:40px;height:40px;" src="/image/search.png"><h2 class="mb-0 ml-3" style="line-height:40px;">動画キーワード検索</h2>
   </div>
    <div style="width:80%;" class="input-group mb-3">
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
$('#search').hide();
newlist();
// ranking();

$('#newlist').on('click',function(){
    $('#search').hide();
    $('#list').show();
    newlist();
});

$('#ranking').on('click',function(){
     $('#search').hide();
    $('#list').show();
    ranking();
});

$('#search_bar').on('click',function(){
    $('#search').show();
    $('#list').hide();
    $('#search_btn').on('click',function(){
        const input= document.getElementById("input");
        // console.log(input.value);
        search(input.value);
    });
    //  search();
     
});



</script>
@endsection
