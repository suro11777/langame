<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Source</th>
        <th>Title</th>
        <th>Content</th>
        <th>Published Date</th>
        <th>Created Date</th>
    </tr>
    </thead>
    <tbody>
    @forelse($articles as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->source }}</td>
            <td>{{ $item->title }}</td>
            <td>{{ $item->content }}</td>
            <td>{{ $item->published_at }}</td>
            <td>{{ $item->created_at->format('d.m.Y H:i') }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="4">Articles not found</td>
        </tr>
    @endforelse
    </tbody>
</table>
