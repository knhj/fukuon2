@extends('layouts.master')

@section('title', 'Fukuon 検索ページ- 副音声共有サービス')

@section('content')

<div  class="jumbotron container py-3">
  <div class="search">
      <div class="d-flex mb-2">
   <image style="width:40px;height:40px;" src="/image/search.png"><h2 class="mb-0 ml-3" style="line-height:40px;">副音声キーワード検索</h2>
   </div>
   
    <div style="width:80%;" class="input-group mb-3">
       <input id="input" type="text" class="form-control"  placeholder="検索キーワード" aria-label="検索キーワード" aria-describedby="basic-addon1" >
       <div class="input-group-append">
       <button id="search_btn" class="btn btn-secondary" type="button">検索</button>
       </div>
    </div>
  </div>
      <table class="table table-borderless table-hover" style="height:25px;">
        <thead class="bg-gray border-bottom border-dark">
          <tr>
            <th scope="col" class="w-50">副音声タイトル</th>
            <th scope="col">投稿者名</th>
            <th scope="col">投稿日時</th>
          </tr>
        </thead>
        <tbody>      
    
         @foreach ($items as $object)
         
         <tr>
             <td><a href="/part/{{$object->video_id}}/{{$object->fukuon_id}}">{{$object->fukuon_title}} </a></td>
             <td>{{$object->name}}</td>
             <td>{{$object->created_at}}</td>
         </tr>
        
        @endforeach
        </tbody>
    </table>
    
        
　　
</div>
  <div class="paginate w-25 mx-auto" >
        	{{ $items->links() }}
        　</div>
<script>
const search_btn = document.getElementById("search_btn");
const input= document.getElementById("input");
search_btn.addEventListener('click', function(e) {
    location.href = '/fukuon_search/'+ input.value;
    
});

</script>

@endsection