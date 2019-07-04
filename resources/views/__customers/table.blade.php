<table class="table">
    <thead>
    <tr>
        <th></th>
        <th>Código</th>
        <th>Status</th>
        <th>Fornecedor ID</th>
        <th>Created at</th>
        <th>Updated at</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($customers as $customer)
    <tr>
        <td>{{ $customer->id }}</td>
        <td>{{ $customer->codigo }}</td>
        <td>{{ $customer->status }}</td>
        <td>{{ $customer->fornecedor()->first()->nome_fantasia }}</td>
        <td>{{ $customer->created_at }}</td>
        <td>{{ $customer->updated_at }}</td>
    </tr>
    @endforeach
    </tbody>
</table>