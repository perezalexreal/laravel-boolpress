<form  class="d-inline-block" action="{{ route($route, $id) }}" method="post">
@csrf    
@method("delete")

<button type="submit" class="btn btn-link text-danger"> 
<i class="fa-regular fa-trash-can"></i>
</button>
</form>