<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Todo List</title>
        <!-- CSSとJavaScriptを追加する領域 -->
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-default">
                <!-- ナビバーの内容 -->
            </nav>
        </div>
        <div class="panel-body">
        <!-- バリデーションエラーの表示に使用するエラーファイル-->
       
        <!-- タスク登録フォーム -->
        <form action="{{ url('tasks') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <!-- タスク名 -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="task" class="col-sm-3 control-label">Task</label>
                    <input type="text" name="task" id="task" class="form-control">
                </div>
            </div>
            <!-- タスク登録ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">Save</button>
                </div>
            </div>
        </form>
        <!-- この下に登録済みタスクリストを表示 -->
    </div>
    </body>
</html>