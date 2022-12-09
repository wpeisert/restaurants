<tr>
    <td>
        @if ($category->image)
        <img src="{{asset('images/' . $category->image)}}" />
        @else
            no image
        @endif
    </td>
    <td>
        {{ $category->name }}
    </td>
    <td>
        {{ $category->description }}
    </td>
    <td>
        {{ $category->sortby }}
    </td>
    <td>
        <input type="checkbox" disabled {{ $category->active ? 'checked' : '' }} />
    </td>

    <td>
        <form action="{{ route('categories.destroy',$category->id) }}" method="POST">
            <a class="btn btn-info" href="{{ route('categories.show',$category->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('categories.edit',$category->id) }}">Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </td>
</tr>
