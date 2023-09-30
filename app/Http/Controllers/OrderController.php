<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use App\Models\Translation;
use App\Models\UploadFile;
use Dompdf\Dompdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $translation = DB::table('translations')->select(['name', 'description'])->distinct()->get();
        // $translation = Translation::get();
        return response()->json($translation);
    }
    public function read()
    {
        $order = Order::where('user_id', auth()->user()->id)->get();
        return view('orders.table', compact('order'));
    }
    public function view($id)
    {
        $order = Order::where('id', $id)->first();
        $user = $order->user->name;
        $translation = Translation::find($order->translation_id);

        // files
        $file = File::find($order->file_id);
        $files = File::where('identifier', $file->identifier)->get();
        $upload_file = UploadFile::find($order->upload_file_id);

        if ($upload_file) {
            $upload_files = UploadFile::where('identifier', $upload_file->identifier)->get();
            return response()->json([$user, $translation, $files, $upload_files]);
        } else {
            return response()->json([$user, $translation, $files]);
        }
    }
    public function payment($id)
    {
        $order = Order::where('id', $id)->first();
        $user = $order->user->name;
        $translation = Translation::find($order->translation_id);
        return response()->json([$order, $user, $translation]);
    }
    public function upload_payment(Request $request, $id)
    {
        $order = Order::where('id', $id)->first();
        $file_identifier = "PAYFILE" . Str::random('13');
        $product_number = "";
        if ($request->product_name == "bca") {
            $product_number = "6565056208";
        } else {
            $product_number = "1120011848";
        }
        try {
            if ($request->hasFile('uploadpayment')) {
                $files = $request->file('uploadpayment');
                foreach ($files as $file) {
                    $name = Str::random(20);
                    $extension = $file->getClientOriginalExtension();
                    $newName = $name . '.' . $extension;
                    $size = $file->getSize();
                    $nameFiles = Payment::where('name', $newName)->first();
                    if ($nameFiles == true) {
                        $name = Str::random(20);
                    }
                    Storage::putFileAs('public/paymentUploadFiles', $file, $newName);
                    Payment::create([
                        'identifier' => $file_identifier,
                        'product' => $request->product_name,
                        'product_number' => $product_number,
                        'sender_name' => $request->upload_sender_name,
                        'sender_number' => $request->upload_sender_number,
                        'name' => $newName,
                        'path' => 'storage/paymentUploadFiles/' . $newName,
                        'size' => $size,
                    ]);
                }
                $searchFiles = Payment::where('identifier', $file_identifier)->first();
                $order->update([
                    'payment_id' => $searchFiles->id,
                ]);
                return response()->json(['success' => 'Payment upload Successfully!']);
            }
            return "Empty Files";
        } catch (Exception $e) {
            return $e->getMessage();
        }
        // return response()->json($nameFiles);
    }
    public function total(Request $request)
    {
        $name = $request->name;
        $type = $request->type;

        if ($name != null && $type != null) {
            $translation_name = Translation::find($name);

            $translation = Translation::where('name', $translation_name->name)->where('description', $translation_name->description)->where('type', $type)->first();

            return $translation->price;
        } else {
            return 0;
        }
    }
    public function upload(Request $request)
    {
        $request->validate([
            'translation_service' => ['required'],
            'type' => ['required'],
        ]);
        $file_identifier = "FILE" . Str::random('16');
        $code = "TRAN" . Str::random('16');
        try {
            if ($request->hasFile('fileinput')) {
                $files = $request->file('fileinput');
                foreach ($files as $file) {
                    $name = Str::random(20);
                    $extension = $file->getClientOriginalExtension();
                    $newName = $name . '.' . $extension;
                    $size = $file->getSize();
                    $nameFiles = File::where('name', $newName)->first();
                    if ($nameFiles == true) {
                        $name = Str::random(20);
                    }
                    Storage::putFileAs('public/files', $file, $newName);
                    File::create([
                        'identifier' => $file_identifier,
                        'name' => $newName,
                        'path' => 'storage/files/' . $newName,
                        'size' => $size,
                    ]);
                }
                $searchFiles = File::where('identifier', $file_identifier)->first();
                Order::create([
                    'translation_id' => $request->translation_service,
                    'user_id' => auth()->user()->id,
                    'file_id' => $searchFiles->id,
                    'upload_file_id' => null,
                    'code' => $code,
                    'status' => "pending",
                    'accepted' => null,
                    'pages' => null,
                    'total_price' => null,
                ]);
                return response()->json(['success' => 'Data update Successfully!']);
            }
            return "Empty Files";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        $file = File::find($order->file_id);

        $allFile = File::where('identifier', $file->identifier)->get();


        foreach ($allFile as $all) {
            $all->delete();
            Storage::delete('public/files/' . $all->name);
        }

        $order->delete();
        return response()->json($order);
    }
    public function print($id)
    {
        $data = Order::find($id);
        $namaFile = $data->code;
        $html = view('orders.print', [
            'no_tran' => $data->code,
            'name' => $data->user->name,
            'translation' => $data->translation->name,
            'total_sheet' => $data->pages,
            'total_price' => $data->total_price,
            'description' => $data->translation->description,
            'type' => $data->translation->type,
        ]);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('invoice_' . $namaFile . '.pdf');
    }
}
