<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportHistory;
use Illuminate\Http\Request;

class TechnicianController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->role === 'teknisi', 403);
        $reports = Report::with('user')->where('technician_id',auth()->id())->latest()->paginate(10);
        return view('technician.dashboard', compact('reports'));
    }

    public function updateStatus(Request $request, Report $report)
    {
        abort_unless(auth()->user()->role === 'teknisi' && $report->technician_id === auth()->id(), 403);
        $data = $request->validate([
            'status'=>'required|in:diproses,menunggu_verifikasi',
            'technician_note'=>'required|string|max:1500',
            'evidence_photo'=>'required_if:status,menunggu_verifikasi|nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        if ($request->hasFile('evidence_photo')) {
            $data['evidence_photo'] = $request->file('evidence_photo')->store('evidence','public');
        }
        $report->update($data);
        ReportHistory::create(['report_id'=>$report->id,'user_id'=>auth()->id(),'status'=>$data['status'],'note'=>$data['technician_note']]);
        return back()->with('success','Progres pekerjaan diperbarui.');
    }
}
