<x-layout>
    <h1>Add Invoice</h1>

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

    <form method="POST" action="/invoice/store">
        @csrf

        <div class="form-group">
    <label>Summary</label>
    <textarea name="summary" required>{{ old('summary') }}</textarea>
</div>

<div class="form-group">
    <label>Business Name</label>
    <input type="text" name="business_name" value="{{ old('business_name') }}" required>
</div>

<div class="form-group">
    <label>Business Address</label>
    <textarea name="business_address" required>{{ old('business_address') }}</textarea>
</div>

<div class="form-group">
    <label>Invoice Due Date</label>
    <input type="date" name="invoice_duedate" value="{{ old('invoice_duedate') }}" required>
</div>

<div class="form-group">
    <label>Amount Due</label>
    <input type="number" step="0.01" name="amount_due" value="{{ old('amount_due') }}" required>
</div>



        <div class="form-group">
            <label>Client Name</label>
            <input type="text" name="client_name" value="{{ old('client_name') }}" required>
        </div>

        <div class="form-group">
            <label>Invoice Number</label>
            <input type="text" name="invoice_number" value="{{ old('invoice_number') }}" required>
        </div>

        <div class="form-group">
            <label>Invoice Date</label>
            <input type="date" name="invoice_date" value="{{ old('invoice_date') }}" required>
        </div>

        <div class="form-group">
            <label>Total Amount</label>
            <input type="number" step="0.01" name="total" value="{{ old('total') }}" required>
        </div>

        <div class="form-group">
            <label>Note</label>
            <textarea name="note">{{ old('note') }}</textarea>
        </div>



        <button class="btn btn-success">Save Invoice</button>
    </form>
</x-layout>
