@foreach ($products as $product)
<tr>
    <td>{{ $product->id }}</td>
    <td>{{ $product->name }}</td>
    <td>{{ $product->category_name }}</td>
    <td>{{ number_format($product->price, 0, ',', '.') }}</td>
    <td>
        <img src="{{ asset('storage/'.$product->image) }}" alt="" width="300px" style="height:200px;">
    </td>

    <td>
        @if($product->hot == 1)
        <span class="badge bg-warning text-dark">HOT</span>
        @else
        <span class="badge bg-primary">Không</span>
        @endif
    </td>
    <td>
        @if($product->status == 'active')
        <span class="badge bg-success">Kích hoạt</span>
        @elseif($product->status == 'inactive')
        <span class="badge bg-danger">Ẩn</span>
        @endif
    </td>
    <td>{{ \Carbon\Carbon::parse($product->dateCreated)->format('d/m/Y H:i') }}</td>
    <td>{{ \Carbon\Carbon::parse($product->dateUpdated)->format('d/m/Y H:i') }}</td>
    <td>
        <div class="btn-group">
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i>
            </a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </td>
</tr>
@endforeach