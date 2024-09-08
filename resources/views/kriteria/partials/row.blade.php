@foreach ($kriteria as $item)
    <tr
        class="{{ $item->parent_id === null && $item->children->isNotEmpty() ? 'parent-row' : ($item->parent_id !== null ? 'children' : '') }}">
        <td class="{{ 'codeLevel-' . $item->level }}">
            {{ $item['kode'] }}
        </td>
        <td>{{ $item['name'] }}</td>
        <td>{{ $item['level'] }}</td>
        <td class="d-flex justify-content-center align-items-center">
            <button class="btn btn-sm btn-info mx-1">Edit</button>
            <button class="btn btn-sm btn-danger mx-1">Delete</button>
        </td>
    </tr>
    @if (!empty($item['children']) && $item->level <= request('level'))
        @include('kriteria.partials.row', ['kriteria' => $item['children']])
    @endif
@endforeach
