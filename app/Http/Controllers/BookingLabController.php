<?php

namespace App\Http\Controllers;

use App\Models\BookingLab;
use App\Models\RoomLab;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BookingLabController extends Controller
{
    public function index()
    {
        if (auth()->user()->can('lihat bookinglab')) {
            return view('dashboard.lab.booking.index');
        } else {
            return abort(403);
        }
    }

    public function create()
    {
        if (auth()->user()->can('tambah bookinglab')) {
            $roomLabs = RoomLab::where('status', 'active')->get();

            return view('dashboard.lab.booking.add', compact('roomLabs'));
        } else {
            return abort(403);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'room_lab_id' => 'required|integer',
                'name' => 'required|string',
                'npm' => 'required|string',
                'angkatan' => 'required|string',
                'event' => 'required|string',
                'participant' => 'required|string',
                'date_start' => 'required|string',
                'date_end' => 'required|string',
                'time_start' => 'required|string',
                'time_end' => 'required|string',
                'lainnya' => 'nullable|string',
            ]);

            $validatedData['user_id'] = Auth::id();
            $validatedData['toga_hakim'] = $request->has('toga_hakim') ? true : false;
            $validatedData['toga_jaksa'] = $request->has('toga_jaksa') ? true : false;
            $validatedData['toga_penasihat_hukum'] = $request->has('toga_penasihat_hukum') ? true : false;
            $validatedData['baju_tahanan'] = $request->has('baju_tahanan') ? true : false;
            $validatedData['baju_petugas_kepolisian'] = $request->has('baju_petugas_kepolisian') ? true : false;

            BookingLab::create($validatedData);

            return redirect(route('dashboard.lab.booking.index'))->with('success', 'Booking Lab successfully added.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create booking lab.');
        }
    }

    public function show($id)
    {
        try {
            $booking = BookingLab::with(['user', 'room_lab'])->findOrFail($id);

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

    public function destroy($id)
    {
        try {
            $booking = BookingLab::findOrFail($id);

            $booking->delete();

            return response()->json([
                'success' => true,
                'message' => 'Booking deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete booking.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        if (auth()->user()->can('edit bookinglab')) {
            try {
                $booking = BookingLab::with(['user', 'room_lab'])->findOrFail($id);
                $rooms = RoomLab::where('status', 'active')->get();

                return view('dashboard.lab.booking.edit', compact('booking', 'rooms'));
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ], 500);
            }
        } else {
            return abort(403);
        }
    }

    public function update($id)
    {
        try {
            $booking = BookingLab::findOrFail($id);

            $validatedData = request()->validate([
                'room_lab_id' => 'required|integer',
                'name' => 'required|string',
                'npm' => 'required|string',
                'angkatan' => 'required|string',
                'event' => 'required|string',
                'participant' => 'required|string',
                'date_start' => 'required|string',
                'date_end' => 'required|string',
                'time_start' => 'required|string',
                'time_end' => 'required|string',
                'lainnya' => 'nullable|string',
            ]);

            $validatedData['user_id'] = Auth::id();
            $validatedData['toga_hakim'] = request()->has('toga_hakim') ? true : false;
            $validatedData['toga_jaksa'] = request()->has('toga_jaksa') ? true : false;
            $validatedData['toga_penasihat_hukum'] = request()->has('toga_penasihat_hukum') ? true : false;
            $validatedData['baju_tahanan'] = request()->has('baju_tahanan') ? true : false;
            $validatedData['baju_petugas_kepolisian'] = request()->has('baju_petugas_kepolisian') ? true : false;

            $booking->update($validatedData);

            return redirect(route('dashboard.lab.booking.index'))->with('success', 'Booking successfully updated.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update booking');
        }
    }

    public function data()
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
                $visionEdit = auth()->user()->can('edit bookinglab') ? 'd-block' : 'd-none';
                $visionDelete = auth()->user()->can('hapus bookinglab') ? 'd-block' : 'd-none';

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
                        <a href="' . route('dashboard.lab.booking.edit', ['booking' => $row->id]) . '"
                           class="' . $visionEdit . ' btn btn-inverse-warning p-2 mr-1"
                           data-bs-tooltip="tooltip" 
                           data-bs-placement="top" 
                           data-bs-title="Edit Booking" 
                           data-bs-custom-class="tooltip-dark">
                            <i class="ti-pencil mx-1 my-2"></i>
                        </a>
                        <button onclick="destroyBookingLab(' . $row->id . ')"
                            type="button" 
                            class="' . $visionDelete . ' btn btn-inverse-danger p-2"
                            data-bs-tooltip="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="Hapus Booking" 
                            data-bs-custom-class="tooltip-dark">
                                <i class="ti-trash mx-1 my-2"></i>
                        </button>
                    </div>
                ';
                return $actionBtn;
            })

            ->rawColumns(['action'])
            ->make(true);
    }
}
