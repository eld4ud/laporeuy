<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    private function guard(): void { abort_unless(auth()->user()->role === 'admin', 403); }

    public function index(Request $request)
    {
        $this->guard();
        $query = Report::with(['user','technician'])->latest();
        if ($request->filled('status')) $query->where('status',$request->status);
        if ($request->filled('date')) $query->whereDate('reported_on',$request->date);
        $reports = $query->paginate(10)->withQueryString();
        $technicians = User::where('role','teknisi')->orderBy('name')->get();
        $counts = [
            'total'=>Report::count(),
            'menunggu'=>Report::where('status','menunggu')->count(),
            'proses'=>Report::whereIn('status',['ditugaskan','diproses','menunggu_verifikasi'])->count(),
            'selesai'=>Report::where('status','selesai')->count(),
        ];
        return view('admin.dashboard', compact('reports','technicians','counts'));
    }

    public function verify(Report $report)
    {
        $this->guard();
        $report->update(['status'=>'diverifikasi']);
        $this->history($report,'diverifikasi','Laporan diverifikasi admin');
        return back()->with('success','Laporan diverifikasi.');
    }

    public function assign(Request $request, Report $report)
    {
        $this->guard();
        $data = $request->validate(['technician_id'=>'required|exists:users,id','admin_note'=>'nullable|string|max:1000']);
        abort_unless(User::whereKey($data['technician_id'])->where('role','teknisi')->exists(), 422);
        $report->update(['technician_id'=>$data['technician_id'],'status'=>'ditugaskan','admin_note'=>$data['admin_note'] ?? null]);
        $this->history($report,'ditugaskan','Tugas diberikan kepada teknisi');
        return back()->with('success','Teknisi berhasil ditugaskan.');
    }

    public function approve(Report $report)
    {
        $this->guard();
        abort_unless($report->status === 'menunggu_verifikasi' && $report->evidence_photo, 422);
        $report->update(['status'=>'selesai']);
        $this->history($report,'selesai','Hasil perbaikan disetujui admin');
        return back()->with('success','Perbaikan disetujui dan laporan selesai.');
    }

    public function reject(Request $request, Report $report)
    {
        $this->guard();
        $data = $request->validate(['admin_note'=>'required|string|max:1000']);
        $report->update(['status'=>'diproses','admin_note'=>$data['admin_note']]);
        $this->history($report,'diproses','Perlu perbaikan ulang: '.$data['admin_note']);
        return back()->with('success','Catatan revisi dikirim ke teknisi.');
    }

    public function createTechnician()
    {
        $this->guard();
        return view('admin.technician-create');
    }

    public function storeTechnician(Request $request)
    {
        $this->guard();
        $data = $request->validate(['name'=>'required|string|max:120','email'=>'required|email|unique:users,email','password'=>'required|string|min:8']);
        User::create([...$data,'role'=>'teknisi']);
        return redirect()->route('admin.dashboard')->with('success','Akun teknisi berhasil dibuat.');
    }

    private function history(Report $report, string $status, ?string $note): void
    {
        ReportHistory::create(['report_id'=>$report->id,'user_id'=>auth()->id(),'status'=>$status,'note'=>$note]);
    }
}
