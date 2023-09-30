<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Translation;
use App\Models\UploadFile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $order = Order::get();
        return view('jobs.index', [
            'order' => $order,
            'status' => $request->status,
        ]);
    }
    public function read($status)
    {
        $jobs = Order::where('status', $status)->get();
        return view('jobs.table', compact('jobs'));
    }
    public function view($status, $id)
    {
        $order = Order::where('id', $id)->first();
        $user = $order->user->name;
        $translation = Translation::find($order->translation_id);
        // files
        $file = File::find($order->file_id);
        $files = File::where('identifier', $file->identifier)->get();
        $payment_file = Payment::find($order->payment_id);
        $upload_file = UploadFile::find($order->upload_file_id);
        if ($payment_file != null && $upload_file == null) {
            $payment_files = Payment::where('identifier', $payment_file->identifier)->get();
            return response()->json([$user, $translation, $files, $order, $payment_files]);
        } else if ($payment_file == null && $upload_file != null) {
            $upload_files = UploadFile::where('identifier', $upload_file->identifier)->get();
            return response()->json([$user, $translation, $files, $order, $upload_files]);
        } else if ($upload_file != null && $payment_file != null) {
            $upload_files = UploadFile::where('identifier', $upload_file->identifier)->get();
            return response()->json([$user, $translation, $files, $order, $upload_files]);
        } else if ($upload_file == null && $payment_file == null) {
            return response()->json([$user, $translation, $files, $order]);
        }
    }
    public function update($status, $id, Request $request)
    {
        $order = Order::where('id', $id)->first();
        $price = $order->translation->price;
        $total = $price * $request->sheet;
        $order->update([
            'status' => "in_progress",
            'accepted' => now(),
            'pages' => $request->sheet,
            'total_price' => $total,
        ]);

        return response()->json("Data Accept Successfully");
    }
    public function upload($status, $id, Request $request)
    {
        $order = Order::where('id', $id)->first();
        $file_identifier = "UPLFILE" . Str::random('13');
        try {
            if ($request->hasFile('fileupload')) {
                $files = $request->file('fileupload');
                foreach ($files as $file) {
                    $name = Str::random(20);
                    $extension = $file->getClientOriginalExtension();
                    $newName = $name . '.' . $extension;
                    $size = $file->getSize();
                    $nameFiles = UploadFile::where('name', $newName)->first();
                    if ($nameFiles == true) {
                        $name = Str::random(20);
                    }
                    Storage::putFileAs('public/uploadFiles', $file, $newName);
                    UploadFile::create([
                        'identifier' => $file_identifier,
                        'name' => $newName,
                        'path' => 'storage/uploadFiles/' . $newName,
                        'size' => $size,
                    ]);
                }
                $searchFiles = UploadFile::where('identifier', $file_identifier)->first();
                $order->update([
                    'upload_file_id' => $searchFiles->id,
                    'status' => "completed",
                ]);
                return response()->json(['success' => 'Data upload Successfully!']);
            }
            return "Empty Files";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
