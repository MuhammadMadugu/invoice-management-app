<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\InvoiceFile;

use Illuminate\Support\Facades\Storage;

class InvoiceFileController extends Controller
{
    //

    public function destroy($id)
{
    $file = InvoiceFile::findOrFail($id);

    // Delete file from storage
    if (Storage::exists($file->path)) {
        Storage::delete($file->path);
    }

    // Delete database record
    $file->delete();

    return back()->with('success', 'File deleted successfully');
}

}
