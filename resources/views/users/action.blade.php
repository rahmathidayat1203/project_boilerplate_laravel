<a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a>
<form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
</form>