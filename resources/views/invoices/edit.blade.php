<x-layout>
    <h1>Edit Invoice</h1>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Update form -->
    <form method="POST" action="/invoice/update/{{ $invoice->id }}">
        @csrf
        @method('PUT') <!-- For Laravel to recognize it as update -->

        <div class="form-group">
            <label>Summary</label>
            <textarea name="summary" required>{{ old('summary', $invoice->summary) }}</textarea>
        </div>

        <div class="form-group">
            <label>Business Name</label>
            <input type="text" name="business_name" value="{{ old('business_name', $invoice->business_name) }}" required>
        </div>

        <div class="form-group">
            <label>Business Address</label>
            <textarea name="business_address" required>{{ old('business_address', $invoice->business_address) }}</textarea>
        </div>

        <div class="form-group">
            <label>Invoice Due Date</label>
            <input type="date" name="invoice_duedate" value="{{ old('invoice_duedate', $invoice->invoice_duedate) }}" required>
        </div>

        <div class="form-group">
            <label>Amount Due</label>
            <input type="number" step="0.01" name="amount_due" value="{{ old('amount_due', $invoice->amount_due) }}" required>
        </div>

        <div class="form-group">
            <label>Client Name</label>
            <input type="text" name="client_name" value="{{ old('client_name', $invoice->client_name) }}" required>
        </div>

        <div class="form-group">
            <label>Invoice Number</label>
            <input type="text" name="invoice_number" value="{{ old('invoice_number', $invoice->invoice_number) }}" required>
        </div>

        <div class="form-group">
            <label>Invoice Date</label>
            <input type="date" name="invoice_date" value="{{ old('invoice_date', $invoice->invoice_date) }}" required>
        </div>

        <div class="form-group">
            <label>Total Amount</label>
            <input type="number" step="0.01" name="total" value="{{ old('total', $invoice->total) }}" required>
        </div>

        <div class="form-group">
            <label>Note</label>
            <textarea name="note">{{ old('note', $invoice->note) }}</textarea>
        </div>

        <button class="btn btn-success">Update Invoice</button>
    </form>
</x-layout>
