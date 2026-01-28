<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Invoice;

class invoiceController extends Controller
{
    //

  public function index(Request $request)
{
    $query = Invoice::query();
    if ($request->search) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('client_name', 'like', "%{$search}%")
              ->orWhere('invoice_number', 'like', "%{$search}%");
        });
    }

    // Filter by status
    if ($request->status == 'paid') {
        $query->where('haspaid', 1);
    } elseif ($request->status == 'unpaid') {
        $query->where('haspaid', 0);
    }

    // Filter by dates
    if ($request->start_date && $request->end_date) {
        // Both dates provided → between start and end
        $query->whereBetween('invoice_date', [$request->start_date, $request->end_date]);
    } elseif ($request->start_date) {
        // Only start date → exactly that date
        $query->whereDate('invoice_date', $request->start_date);
    } elseif ($request->end_date) {
        // Only end date → exactly that date
        $query->whereDate('invoice_date', $request->end_date);
    }

    $invoices = $query->orderBy('created_at', 'desc')->get();

    return view('invoices.index', ['invoices' => $invoices]);
}



    public function show($id){
      
      $invoice = Invoice::findOrFail($id);

      return view('invoices.show',['invoice'=>$invoice]);

    }

       public function modify($id){
      
      $invoice = Invoice::findOrFail($id);

      return view('invoices.edit',['invoice'=>$invoice]);

    }


  public function store(Request $request)
{
    // 1️⃣ Validate the request
    $request->validate([
        'summary' => 'required|string',
        'business_name' => 'required|string|max:255',
        'business_address' => 'required|string',
        'invoice_date' => 'required|date',
        'invoice_duedate' => 'required|date|after_or_equal:invoice_date',
        'amount_due' => 'required|numeric',
        'client_name' => 'required|string|max:255',
        'client_business' => 'nullable|string|max:255',
        'client_business_address' => 'nullable|string',
        'client_email' => 'nullable|email|max:255',
        'client_phone' => 'nullable|string|max:20',
        'reminders' => 'nullable|string|max:255',
        'sum' => 'nullable|numeric',
        'vat' => 'nullable|numeric',
        'other_vat' => 'nullable|numeric',
        'transaction_fee' => 'nullable|numeric',
        'total' => 'required|numeric',
        'vat_percent' => 'nullable|string|max:255',
        'other_vat_percent' => 'nullable|string|max:255',
        'tax_name' => 'nullable|string|max:255',
        'note' => 'nullable|string',
        'haspaid' => 'nullable|boolean',
        'ref' => 'nullable|string|max:255',
        'status' => 'nullable|integer',
    ]);

    // 2️⃣ Create new Invoice
    $invoice = new Invoice();

    // 3️⃣ Fill the invoice fields
    $invoice->summary = $request->summary;
    $invoice->business_name = $request->business_name;
    $invoice->business_address = $request->business_address;
    $invoice->invoice_number = $request->invoice_number ?? 'INV-' . strtoupper(uniqid());
    $invoice->invoice_date = $request->invoice_date;
    $invoice->invoice_duedate = $request->invoice_duedate;
    $invoice->amount_due = $request->amount_due;
    $invoice->client_name = $request->client_name;
    $invoice->client_business = $request->client_business ?? 'None';
    $invoice->client_business_address = $request->client_business_address ?? 'None';
    $invoice->client_email = $request->client_email ?? 'NILL';
    $invoice->client_phone = $request->client_phone ?? 'NIll';
    $invoice->reminders = $request->reminders;
    $invoice->sum = $request->sum ?? 0;
    $invoice->vat = $request->vat ?? 0;
    $invoice->other_vat = $request->other_vat ?? 0;
    $invoice->transaction_fee = $request->transaction_fee ?? 0;
    $invoice->total = $request->total;
    $invoice->vat_percent = $request->vat_percent ?? 0;
    $invoice->other_vat_percent = $request->other_vat_percent ?? 0;
    $invoice->tax_name = $request->tax_name ?? 'Nill';
    $invoice->note = $request->note ?? 'Nill';
    $invoice->haspaid = $request->haspaid ?? 0;
    $invoice->ref = $request->ref;
    $invoice->user_id = 2;
    //$invoice->user_id = auth()->id(); // current logged-in user
    $invoice->status = $request->status ?? 0;

    // 4️⃣ Save invoice
    $invoice->save();

    // 5️⃣ Redirect back with success message
    return redirect()->route('invoices.index')
                     ->with('success', 'Invoice created successfully!');
}



// Handle update request
public function update(Request $request, $id)
{
    // Validation
    $request->validate([
        'summary' => 'required|string',
        'business_name' => 'required|string',
        'business_address' => 'required|string',
        'invoice_duedate' => 'required|date',
        'amount_due' => 'required|numeric',
        'sum' => 'nullable|numeric',
        'client_name' => 'required|string',
        'invoice_number' => 'required|numeric',
        'invoice_date' => 'required|date',
        'total' => 'required|numeric',
    ]);

    // Find the invoice
    $invoice = Invoice::findOrFail($id);

    // Update fields
    $invoice->summary = $request->summary;
    $invoice->business_name = $request->business_name;
    $invoice->business_address = $request->business_address;
    $invoice->invoice_duedate = $request->invoice_duedate;
    $invoice->amount_due = $request->amount_due;
    $invoice->sum = $request->sum ?? 0;
    $invoice->client_name = $request->client_name;
    $invoice->invoice_number = $request->invoice_number;
    $invoice->invoice_date = $request->invoice_date;
    $invoice->total = $request->total;
    $invoice->note = $request->note;

    $invoice->save();

    // Redirect back with success message
    return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully!');
}



// Handle update request
public function update_status(Request $request, $id)
{
    // Validation
    $request->validate([
        'paymentStatus' => 'required|numeric',
    ]);

    // Find the invoice
    $invoice = Invoice::findOrFail($id);

    // Update fields
 
    $invoice->haspaid = $request->paymentStatus;

    $invoice->save();

    // Redirect back with success message
   return redirect('/invoice/show/' . $invoice->id)
                 ->with('success', 'Invoice updated successfully!');

}




    public function create(){

        return view('invoices.add');
    }


    public function destroy($id)
{
    $invoice = Invoice::findOrFail($id); // Find invoice or fail
    $invoice->delete(); // Delete the invoice
    return response()->json(['success' => true]); // Return JSON for JS
}


public function uploadFile(Request $request, Invoice $invoice)
{
    $request->validate([
        'file' => 'required|file|max:10240', // max 10MB
    ]);

    $uploadedFile = $request->file('file');
    $filename = time().'_'.$uploadedFile->getClientOriginalName();
    $path = $uploadedFile->storeAs('invoices/'.$invoice->id, $filename, 'public');

    // Save in database
    $invoice->files()->create([
        'filename' => $filename,
        'path' => $path,
    ]);

    return redirect()->back()->with('success', 'File uploaded successfully!');
}

public function deleteFile(InvoiceFile $file)
{
    // Delete from storage
    \Storage::disk('public')->delete($file->path);

    // Delete from DB
    $file->delete();

    return redirect()->back()->with('success', 'File deleted successfully!');
}









}
