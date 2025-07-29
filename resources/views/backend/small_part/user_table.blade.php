<table id="autoloadTable" class="table table-centered table-nowrap mb-0">
    <thead class="thead-light ">
        <tr class="text-center">
            <th>SL</th>
            <th>User Name</th>
            <th>Uid</th>
            <th>Role </th>
            <th>Current Balance </th>
            <th>Status </th>
            <th>Country </th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="test">
    </tbody>
</table>
@section('javacript')
    <script>
        var page = 1;
        autoLoadData(page);

        function autoLoadData(page) {
            $.ajax({
                    url: '?page=' + page,
                    type: 'get',
                })
                .done(function(data) {
                    if (data.length == 0) {
                        $('#autoloadTable').DataTable();
                        return;
                    } else {
                        // console.log(data);
                        $('#test').append(data);
                        autoLoadData(++page);
                    }
                })
        }
    </script>
@endsection
