<table class="table table-bordered">
    <thead>
        <th scope="row">Title</th>
        <th scope="row">Course code</th>
    </thead>
    <tbody>
        @foreach ($subjects as $subject)
            @if($subject->code != "RLE 101" && $subject->code != "RLE 103")
                <tr>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->code }}</td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>