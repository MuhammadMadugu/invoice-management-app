<x-layout>
    <h1>Invoice Details</h1>

    <div class="invoice-details">

        <!-- Existing Invoice Details -->
        <div class="detail-group">
            <span class="label">Summary:</span>
            <span class="value">{{ $invoice->summary }}</span>
        </div>

        <div class="detail-group">
            <span class="label">Business Name:</span>
            <span class="value">{{ $invoice->business_name }}</span>
        </div>

        <div class="detail-group">
            <span class="label">Business Address:</span>
            <span class="value">{{ $invoice->business_address }}</span>
        </div>

        <div class="detail-group">
            <span class="label">Invoice Due Date:</span>
            <span class="value">{{ \Carbon\Carbon::parse($invoice->invoice_duedate)->format('jS M Y') }}</span>
        </div>

        <div class="detail-group">
            <span class="label">Amount Due:</span>
            <span class="value">₦{{ number_format($invoice->amount_due, 2) }}</span>
        </div>

        <div class="detail-group">
            <span class="label">Client Name:</span>
            <span class="value">{{ $invoice->client_name }}</span>
        </div>

        <div class="detail-group">
            <span class="label">Invoice Number:</span>
            <span class="value">{{ $invoice->invoice_number }}</span>
        </div>

        <div class="detail-group">
            <span class="label">Invoice Date:</span>
            <span class="value">{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('jS M Y') }}</span>
        </div>

        <div class="detail-group">
            <span class="label">Total Amount:</span>
            <span class="value">₦{{ number_format($invoice->total, 2) }}</span>
        </div>

        <div class="detail-group">
            <span class="label">Note:</span>
            <span class="value">{{ $invoice->note }}</span>
        </div>

        <div class="detail-group">
            <span class="label">Status:</span>
            @if($invoice->haspaid)
                <span class="status-badge paid">Paid</span>
            @else
                <span class="status-badge unpaid">Not Paid</span>
            @endif
        </div>


   <!-- Update Status Form -->
<form method="POST" action="/invoice/updateStatus/{{ $invoice->id }}">
    @csrf
    @method('PUT') <!-- Laravel PUT for update -->

    <input type="hidden" name="paymentStatus" value="{{ $invoice->haspaid ? 0 : 1 }}">

    <div align="center"><button type="submit" class="btn btn-success">
        {{ $invoice->haspaid ? 'Mark as Unpaid' : 'Mark as Paid' }}
    </button></div>
</form>


        <div class="detail-group" style="margin: 10px;">
            <a href="{{ route('invoices.index') }}" class="btn-action btn-view">Back to Invoices</a>
        </div>

        <!-- Upload Related File -->
        <div class="file-upload-section">
            <h3>Upload Related File</h3>
            <form action="{{ route('invoices.files.upload', $invoice->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" required>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>

        <!-- List of Related Files -->
        <div class="related-files">
            <h3>Related Files</h3>
            @if($invoice->files->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>File Name</th>
                        <th>Uploaded At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice->files as $file)
                        <tr>
                            <td>{{ $file->filename }}</td>
                            <td>{{ \Carbon\Carbon::parse($file->created_at)->format('jS M Y H:i') }}</td>
                            <td>
                                <a href="{{ asset('storage/app/public/' . $file->path) }}" target="_blank" class="btn btn-view">View</a>
                                <form action="{{ route('invoices.files.delete', $file->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <p>No files uploaded yet.</p>
            @endif
        </div>

    </div>

    <style>
        .file-upload-section, .related-files {
            margin-top: 30px;
            padding: 15px;
            background: #f1f5f9;
            border-radius: 8px;
        }

        .file-upload-section h3, .related-files h3 {
            margin-bottom: 15px;
        }

        .file-upload-section input[type="file"] {
            margin-right: 10px;
        }

        .table th, .table td {
            padding: 10px 8px;
        }

        .btn-view {
            background: linear-gradient(135deg, #63b3ed 0%, #4299e1 100%);
            color: white;
            padding: 6px 14px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-delete {
            background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
            color: white;
            padding: 6px 14px;
            border-radius: 5px;
            border: none;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-delete:hover, .btn-view:hover {
            opacity: 0.85;
        }
    </style>

</x-layout>
