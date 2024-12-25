<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Holiday;
use App\Models\Permission;
use App\Models\Presence;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $attendances = Attendance::query()
            // ->with('positions')
            ->forCurrentUser(auth()->user()->position_id)
            ->get()
            ->sortByDesc('data.is_end')
            ->sortByDesc('data.is_start');

        return view('home.index', [
            "title" => "Beranda",
            "attendances" => $attendances
        ]);
    }

    public function show(Attendance $attendance)
    {
        $presences = Presence::query()
            ->where('attendance_id', $attendance->id)
            ->where('user_id', auth()->user()->id)
            ->get();

        $isHasEnterToday = $presences
            ->where('presence_date', now()->toDateString())
            ->isNotEmpty();

        $isTherePermission = Permission::query()
            ->where('permission_date', now()->toDateString())
            ->where('attendance_id', $attendance->id)
            ->where('user_id', auth()->user()->id)
            ->first();

        $data = [
            'is_has_enter_today' => $isHasEnterToday,
            'is_not_out_yet' => $presences->where('presence_out_time', null)->isNotEmpty(),
            'is_there_permission' => (bool) $isTherePermission,
            'is_permission_accepted' => $isTherePermission?->is_accepted ?? false
        ];

        $holiday = isset($attendance['data']['is_holiday_today']) && $attendance['data']['is_holiday_today']
            ? Holiday::query()
            ->where('holiday_date', now()->toDateString())
            ->first()
            : false;

        $history = Presence::query()
            ->where('user_id', auth()->user()->id)
            ->where('attendance_id', $attendance->id)
            ->get();

        $priodDate = CarbonPeriod::create($attendance->created_at->toDateString(), now()->toDateString())
            ->toArray();

        foreach ($priodDate as $i => $date) {
            $priodDate[$i] = $date->toDateString();
        }

        $priodDate = array_slice(array_reverse($priodDate), 0, 30);

        return view('home.show', [
            "title" => "Informasi Absensi Kehadiran",
            "attendance" => $attendance,
            "data" => $data,
            "holiday" => $holiday,
            'history' => $history,
            'priodDate' => $priodDate
        ]);
    }

    public function permission(Attendance $attendance)
    {
        return view('home.permission', [
            "title" => "Form Permintaan Izin",
            "attendance" => $attendance
        ]);
    }

    public function sendEnterPresenceUsingQRCode()
    {
        $code = request('code');
        $attendance = Attendance::query()->where('code', $code)->first();

        if ($attendance && $attendance->data->is_start && $attendance->data->is_using_qrcode) {
            Presence::create([
                "user_id" => auth()->user()->id,
                "attendance_id" => $attendance->id,
                "presence_date" => now()->toDateString(),
                "presence_enter_time" => now()->toTimeString(),
                "presence_out_time" => null
            ]);

            return response()->json([
                "success" => true,
                "message" => "Kehadiran atas nama '" . auth()->user()->name . "' berhasil dikirim."
            ]);
        }

        return response()->json([
            "success" => false,
            "message" => "Terjadi masalah pada saat melakukan absensi."
        ], 400);
    }

    private const ERROR_MESSAGE = "Terjadi masalah pada saat melakukan absensi.";
    protected $data = [];

    public function sendOutPresenceUsingQRCode()
    {
        $code = request('code');
        $attendance = Attendance::query()->where('code', $code)->first();

        if (!$this->isValidAttendance($attendance)) {
            return $this->jsonErrorResponse();
        }

        $presence = $this->getPresence($attendance);

        if (!$presence) {
            return $this->jsonErrorResponse();
        }

        $this->data['is_not_out_yet'] = false;
        $presence->update(['presence_out_time' => now()->toTimeString()]);

        return $this->jsonSuccessResponse("Absensi keluar berhasil dilakukan.");
    }

    private function isValidAttendance($attendance): bool
    {
        return $attendance && (!$attendance->data->is_end && !$attendance->data->is_using_qrcode);
    }

    private function getPresence($attendance)
    {
        return Presence::query()
            ->where('user_id', auth()->user()->id)
            ->where('attendance_id', $attendance->id)
            ->where('presence_date', now()->toDateString())
            ->where('presence_out_time', null)
            ->first();
    }

    private function jsonErrorResponse()
    {
        return response()->json([
            "success" => false,
            "message" => self::ERROR_MESSAGE,
        ], 400);
    }

    private function jsonSuccessResponse(string $message)
    {
        return response()->json([
            "success" => true,
            "message" => $message,
        ]);
    }
}
