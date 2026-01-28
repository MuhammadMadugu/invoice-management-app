<x-layout>
	<h1>Invoices</h1>

<form method="GET" action="{{ route('invoices.index') }}" class="filter-form">
   
    <div class="filter-group">
        <label>(Search):</label>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Client name,invoice number">
    </div> 
      
    <div class="filter-group">
        <label>Status:</label>
        <select name="status">
            <option value="">All</option>
            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
            <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
        </select>
    </div>

    <div class="filter-group">
        <label>Start Date:</label>
        <input type="date" name="start_date" value="{{ request('start_date') }}">
    </div>

    <div class="filter-group">
        <label>End Date:</label>
        <input type="date" name="end_date" value="{{ request('end_date') }}">
    </div>

    <div class="filter-group">
        <button type="submit" class="btn-filter">Filter</button>
    </div>
</form>


<table class="table">
    <thead>
        <tr>
            <th>Invoice #</th>
            <th>Client</th>
            <th>Total</th>
            <th>Status</th>
            <th>Date</th>
            <th colspan="3">actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($invoices as $invoice)
        <tr>
            <td>{{ $invoice->invoice_number }}</td>
            <td>{{ $invoice->client_name }}</td>
            <td>₦{{ number_format($invoice->total, 2) }}</td>
            <td>
                @if($invoice->haspaid)
                    <span class="badge badge-paid">Paid</span>
                @else
                    <span class="badge badge-unpaid">Unpaid</span>
                @endif
            </td>
            <td>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('jS M Y') }}</td>
     <td>
    <a href="/invoice/edit/{{ $invoice->id }}" class="btn-action btn-edit">
        Edit
    </a>
</td>
  <td>
    <a href="/invoice/show/{{ $invoice->id }}" class="btn-action btn-view">
        view
    </a>
</td>
<td>
    <a href="javascript:void(0)" 
       onclick="delete_invoice({{ $invoice->id }})" 
       class="btn-action btn-delete">
        Delete
    </a>
</td>

        </tr>
        @endforeach
    </tbody>


</table>

<script>
function delete_invoice(invoice_id) {
    if(confirm("Are you sure you want to delete this invoice?")) {

        fetch('/invoice/' + invoice_id, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success){
                alert("Invoice deleted successfully!");
                // Option 1: Reload page
                location.reload();

                // Option 2: Remove row dynamically (optional)
                // document.getElementById('invoice-row-' + invoice_id).remove();
            } else {
                alert("Error deleting invoice");
            }
        })
        .catch(err => {
            console.error(err);
            alert("Something went wrong!");
        });
    }
}
</script>

</x-layout>