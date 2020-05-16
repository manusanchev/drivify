

<form method="post" action="{{route('logout')}}">
    {{ csrf_field() }}
    <input type="submit" value="Enviar">
</form>
