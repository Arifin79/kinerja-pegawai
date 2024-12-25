@if($attendance['data']['is_holiday_today'])
    <span class="badge text-bg-success rounded-pill">Hari Libur</span>
@else
@if (isset($attendance['data']['is_start']) && $attendance['data']['is_start'])
    <span class="badge bg-primary rounded-pill">Jam Masuk</span>
<span class="badge text-bg-warning rounded-pill">Jam Pulang</span>
@else
<span class="badge text-bg-danger rounded-pill">Tutup</span>
@endif

@endif