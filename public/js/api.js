$(function(){
 
 
    // 登録する関数
   function storeData(){
       //
   }

   // 表示する関数
   function indexData(){
       
        var ajax = new XMLHttpRequest();
        ajax.open("get", "/api/");
        ajax.responseType = 'json';
        ajax.send();
        ajax.onload = function (e) {
         console.log(e.target.response[0]);
         
        }
        
    //       const url = '/api/';
    //   $.getJSON(url)
    //   .done(function (data, textStatus, jqXHR) {
    //       console.log(data['name']);
    //   })
    //   .fail(function (jqXHR, textStatus, errorThrown) {
    //       console.log(jqXHR.status + textStatus + errorThrown);
    //   })
    //   .always(function () {
    //       console.log('get:complete');
    //   });
        
        
        
        
        
        
        
        
   }

   // 削除する関数
   function deleteData(id){
       //
   }

    
     indexData();
 
 
 
 
 
});