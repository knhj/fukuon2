@extends('layouts.master')

@section('title', 'Fukuon - 副音声共有サービス')

@section('content')

<!---->
  <div  class="jumbotron py-3">
    <div class="d-flex mb-2">
      <image style="width:40px;height:40px;" src="/image/head.png"><h2 class="mb-0 ml-3" style="line-height:40px;">新着副音声</h2>
    </div>
    
    <table class="table table-borderless table-hover">
        <thead class="bg-gray border-bottom border-dark">
            <tr>
                <th scope="col" class="w-50">副音声タイトル</th>
         <th scope="col">投稿者名</th>
          <th scope="col">投稿日時</th>
          </tr>
          </thead>
    <tbody>      
    
 @foreach ($item as $object)
 
 <tr >
     <td><a href="/part/{{$object->video_id}}/{{$object->fukuon_id}}">{{$object->fukuon_title}} </a></td>
     <td>{{$object->name}}</td>
     <td>{{$object->created_at}}</td>
 </tr>

@endforeach
</tbody>
</table>
     </div>
       <div class="paginate w-25 mx-auto" >
        	{{ $item->links() }}
        　</div>
</div>
<!---->


<!---->







@endsection
