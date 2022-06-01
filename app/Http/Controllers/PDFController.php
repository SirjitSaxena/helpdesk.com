<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\Timetable;

class PDFController extends Controller
{
    public function download_notice($id)
    {
        $download = Notice::find($id);
        $path = public_path("noticefile/$download->pdf");
        return response()->download($path);
    }
    public function delete_notice($id){
        $delete=Notice::find($id);
        if(!is_null($delete)){
            unlink(public_path("noticefile/$delete->pdf"));
            $delete->delete();
            return redirect('notice_admin')->with('message', 'Notice Deleted Successfully');
        }
        return redirect('notice_admin');
    }
    public function download_timetable($id)
    {
        $download = Timetable::find($id);
        $path = public_path("timetablefile/$download->pdf");
        return response()->download($path);
    }
    public function delete_timetable($id){
        $delete=Timetable::find($id);
        if(!is_null($delete)){
            unlink(public_path("timetablefile/$delete->pdf"));
            $delete->delete();
            return redirect('timetable_admin')->with('message', 'Timetable Deleted Successfully');
        }
        return redirect('timetable_admin');
    }
    public function view_timetable($id)
    {
        $view = Timetable::find($id);
        $path = public_path("timetablefile/$view->pdf");
        $data = compact('path');
       return response()->file($path);
        
    }
}