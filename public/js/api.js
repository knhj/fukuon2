   // データからhtmlを出力する関数
//   function make_dom(data){
//       var str = '';
//       for (var i=0;i<data.length;i++){
//           str += `<tr>
//                       <td class="table-text">
//                           ${data[i].task}
//                       </td>
//                       <td class="table-text">
//                           ${data[i].deadline}
//                       </td>
//                       <td class="table-text">
//                           ${data[i].comment}
//                       </td>
//                       <td>
//                           <button type="button" class="btn btn-danger destroy" id="${data[i].id}">削除</button>
//                       </td>
//                   </tr>`;
//       }
//       return str;
//   }



    // 登録する関数
   function storeData(){
       //
   }

   // 表示する関数
   function newlist(){
        var str = "";
        var ajax = new XMLHttpRequest();
        ajax.open("get", "/api/");
        ajax.responseType = 'json';
        ajax.send();
        ajax.onload = function (e) {
             console.log(e.target.response);
             var obj = e.target.response;
            //  console.log(obj.length);
             
             for(var i = 0; i < obj.length ; i++ ) {
            //   Object.keys(obj[i]).forEach(function (key) {
            //  console.log(key + "は" + obj[i][key] + "と鳴いた！");
             //   });
             
                  str += `<tr>
                             <td><a href="/part//">${obj[i].fukuon_title}</a></td>
                             <td>${obj[i].name}</td>
                             <td>${obj[i].created_at}</td>
                             <td>${obj[i].play_count}</td>
                             </tr>`;
             }
            //  console.log(str);
         $('#echo').html(str);
        }
   }
   
   
    // 表示する関数
   function ranking(){
        var str = "";
        var ajax = new XMLHttpRequest();
        ajax.open("get", "/api/ranking");
        ajax.responseType = 'json';
        ajax.send();
        ajax.onload = function (e) {
             console.log(e.target.response);
             var obj = e.target.response;
             console.log(obj);
             
             for(var i = 0; i < obj.length ; i++ ) {
                  str += `<tr>
                             <td><a href="/part//">${obj[i].fukuon_title}</a></td>
                             <td>${obj[i].name}</td>
                             <td>${obj[i].created_at}</td>
                             <td>${obj[i].play_count}</td>
                             </tr>`;
             }
            //  console.log(str);
         $('#echo').html(str);
        }
   }
   
   

   // 削除する関数
   function deleteData(id){
       //
   }

    
    
 
 
