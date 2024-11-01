<?php

namespace App\Http\Controllers;

use App\Models\BookingLab;
use App\Models\JadwalPraktikum;
use App\Models\KurikulumLab;
use App\Models\ModulPraktikum;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FrontPraktikumController extends Controller
{
    function kurikulumLab()
    {
        return view('praktikum.kurikulum-lab');
    }

    function dataKurikulumLab()
    {
        $kurikulumLab = KurikulumLab::with(['user'])
            ->orderBy('id', 'desc')
            ->get();

        return DataTables::of($kurikulumLab)
            ->addIndexColumn()
            ->addColumn('materi', function ($row) {
                return $row->materi;
            })
            ->addColumn('mata_kuliah', function ($row) {
                return $row->mata_kuliah;
            })
            ->addColumn('semester', function ($row) {
                return $row->semester;
            })
            ->addColumn('tahun_akademik', function ($row) {
                return $row->tahun_akademik;
            })
            ->addColumn('file', function ($row) {
                if ($row->file) {
                    $file = '
                        <a href="' . asset('storage/filepond-file/' . $row->file) . '" target="_blank"
                           class="btn btn-inverse-info p-2 mr-1"
                           data-bs-tooltip="tooltip" 
                           data-bs-placement="top" 
                           data-bs-title="Unduh Modul Praktikum" 
                           data-bs-custom-class="tooltip-dark">
                            <i class="ti-download mx-1 my-2"></i>
                        </a>
                    ';
                } else if ($row->link) {
                    $file = '
                        <a href="' . $row->link . '" target="_blank"
                           class="btn btn-inverse-info p-2 mr-1"
                           data-bs-tooltip="tooltip" 
                           data-bs-placement="top" 
                           data-bs-title="Unduh Modul Praktikum" 
                           data-bs-custom-class="tooltip-dark">
                            <i class="ti-download mx-1 my-2"></i>
                        </a>
                    ';
                } else {
                    $file = 'File Tidak Tersedia';
                }

                return $file;
            })
            ->rawColumns(['file'])
            ->make(true);
    }

    function peminjamanLab()
    {
        return view('praktikum.peminjaman-lab');
    }

    function dataPeminjamanLab()
    {
        $bookings = BookingLab::with(['user', 'room_lab'])
            ->orderBy('id', 'desc')
            ->get();

        return DataTables::of($bookings)
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->addColumn('date', function ($row) {
                if ($row->date_start == $row->date_end) {
                    return Carbon::parse($row->date_start)->translatedFormat('d F Y');
                } else {
                    return Carbon::parse($row->date_start)->translatedFormat('d F Y') . ' - ' .  Carbon::parse($row->date_end)->translatedFormat('d F Y');
                }
            })
            ->addColumn('time', function ($row) {
                return $row->time_start . ' - ' . $row->time_end;
            })
            ->addColumn('event', function ($row) {
                return $row->event;
            })
            ->addColumn('room', function ($row) {
                return $row->room_lab->name;
            })
            ->addColumn('action', function ($row) {
                $actionBtn = '
                    <div class="d-flex">
                        <button onclick="showBookingLab(' . $row->id . ')"
                            type="button" 
                            class="btn btn-inverse-info p-2 mr-1"
                            data-bs-tooltip="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="Detail Booking" 
                            data-bs-custom-class="tooltip-dark">
                                <i class="ti-eye mx-1 my-2"></i>
                        </button>
                    </div>
                ';
                return $actionBtn;
            })

            ->rawColumns(['action'])
            ->make(true);
    }

    public function detailPeminjamanLab($id)
    {
        try {
            $booking = BookingLab::findOrFail($id)->with(['user', 'room_lab'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Booking lab find successfully.',
                'data' => $booking,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to find booking lab.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    function modulPraktikum()
    {
        return view('praktikum.modul');
    }

    function dataModulPraktikum()
    {
        $modulPraktikum = ModulPraktikum::with(['user'])
            ->orderBy('id', 'desc')
            ->get();

        return DataTables::of($modulPraktikum)
            ->addIndexColumn()
            ->addColumn('materi', function ($row) {
                return $row->materi;
            })
            ->addColumn('mata_kuliah', function ($row) {
                return $row->mata_kuliah;
            })
            ->addColumn('semester', function ($row) {
                return $row->semester;
            })
            ->addColumn('tahun_akademik', function ($row) {
                return $row->tahun_akademik;
            })
            ->addColumn('file', function ($row) {
                if ($row->file) {
                    $file = '
                        <a href="' . asset('storage/filepond-file/' . $row->file) . '" target="_blank"
                           class="btn btn-inverse-info p-2 mr-1"
                           data-bs-tooltip="tooltip" 
                           data-bs-placement="top" 
                           data-bs-title="Unduh Modul Praktikum" 
                           data-bs-custom-class="tooltip-dark">
                            <i class="ti-download mx-1 my-2"></i>
                        </a>
                    ';
                } else if ($row->link) {
                    $file = '
                        <a href="' . $row->link . '" target="_blank"
                           class="btn btn-inverse-info p-2 mr-1"
                           data-bs-tooltip="tooltip" 
                           data-bs-placement="top" 
                           data-bs-title="Unduh Modul Praktikum" 
                           data-bs-custom-class="tooltip-dark">
                            <i class="ti-download mx-1 my-2"></i>
                        </a>
                    ';
                } else {
                    $file = 'File Tidak Tersedia';
                }

                return $file;
            })
            ->rawColumns(['file'])
            ->make(true);
    }

    function jadwalPraktikum()
    {
        return view('praktikum.jadwal');
    }

    function dataJadwalPraktikum()
    {
        $jadwalPraktikum = JadwalPraktikum::with(['user'])
            ->orderBy('id', 'desc')
            ->get();

        return DataTables::of($jadwalPraktikum)
            ->addIndexColumn()
            ->addColumn('instruktur', function ($row) {
                return $row->instruktur;
            })
            ->addColumn('materi', function ($row) {
                return $row->materi;
            })
            ->addColumn('mata_kuliah', function ($row) {
                return $row->mata_kuliah;
            })
            ->addColumn('kelas', function ($row) {
                return $row->kelas;
            })
            ->addColumn('date', function ($row) {
                if ($row->date_start == $row->date_end) {
                    return Carbon::parse($row->date_start)->translatedFormat('d F Y');
                } else {
                    return Carbon::parse($row->date_start)->translatedFormat('d F Y') . ' - ' .  Carbon::parse($row->date_end)->translatedFormat('d F Y');
                }
            })
            ->addColumn('time', function ($row) {
                return $row->time_start . ' - ' . $row->time_end;
            })
            ->make(true);
    }
}
