<div>
    <table id="dataTable" class="display">
        <thead>
            <tr>
                @foreach($columns as $column)
                <th>{{ $column }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                @foreach($columns as $column)
                <td>{{ $item[$column] }}</td> 
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            pageLength: {
                {
                    $itemsPerPage
                }
            },
            language: {
                url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/Portuguese.json'
            }
        });
    });
</script>
@endpush
