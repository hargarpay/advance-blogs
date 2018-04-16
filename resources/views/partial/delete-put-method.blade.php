<form id="delete-method" action="" method="POST" style="display: none;">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="delete">
</form>

<form id="put-method" action="" method="POST" style="display: none;">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="put">
</form>