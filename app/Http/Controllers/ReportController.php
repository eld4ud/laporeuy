<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function landing()
    {
        $stats = [
            'total' => Report::count(),
            'selesai' => Report::where('status','selesai')->count(),
            'proses' => Report::whereIn('status',['ditugaskan','diproses','menunggu_verifikasi'])->count(),
        ];
        return view('landing', compact('stats'));
    }

    public function dashboard(Request $request)
    {
        abort_unless($request->user()->isRole('siswa','guru'), 403);
        $reports = Report::where('user_id',$request->user()->id)->latest()->paginate(8);
        return view('reports.dashboard', compact('reports'));
    }

    public function create(Request $request)
    {
        abort_unless($request->user()->isRole('siswa','guru'), 403);
        return view('reports.create');
    }

    public function store(Request $request)
    {
        abort_unless($request->user()->isRole('siswa','guru'), 403);
        $data = $request->validate([
            'title'=>'required|string|max:150',
            'category'=>'required|string|max:80',
            'location'=>'required|string|max:100',
            'description'=>'required|string|min:10',
            'photo'=>'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        $data['photo'] = $request->file('photo')->store('reports','public');
        $data['user_id'] = $request->user()->id;
        $data['reported_on'] = now()->toDateString();
        $data['status'] = 'menunggu';
        $report = Report::create($data);
        ReportHistory::create(['report_id'=>$report->id,'user_id'=>$request->user()->id,'status'=>'menunggu','note'=>'Laporan dibuat']);
        return redirect()->route('reports.show',$report)->with('success','Laporan berhasil dikirim.');
    }

    public function show(Request $request, Report $report)
    {
        $user = $request->user();
        abort_unless($user->role === 'admin' || $report->user_id === $user->id || $report->technician_id === $user->id, 403);
        $report->load(['user','technician','histories.user']);
        return view('reports.show', compact('report'));
    }
}
